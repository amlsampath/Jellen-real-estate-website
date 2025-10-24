<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\MediaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        $blogPosts = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.blog-posts.index', compact('blogPosts'));
    }
    
    public function create()
    {
        return view('admin.blog-posts.create');
    }
    
    public function store(Request $request)
    {
        \Log::info('Blog post store method called', [
            'request_data' => $request->all(),
            'has_files' => $request->hasFile('featured_image'),
            'admin_id' => session('admin_id')
        ]);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'required|string|max:100',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published,archived',
        ]);
        
        \Log::info('Validation passed, processing request data');
        
        $data = $request->all();
        $data['created_by'] = session('admin_id');
        $data['slug'] = Str::slug($request->title);
        
        // Convert tags from JSON string to array
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = json_decode($data['tags'], true);
        }
        
        \Log::info('About to process image upload', [
            'has_file' => $request->hasFile('featured_image'),
            'file_valid' => $request->hasFile('featured_image') ? $request->file('featured_image')->isValid() : false
        ]);
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $featuredImage->getClientOriginalExtension();
            
            // Get file information BEFORE moving the file
            $originalName = $featuredImage->getClientOriginalName();
            $fileSize = $featuredImage->getSize();
            $mimeType = $featuredImage->getMimeType();
            
            \Log::info('Starting blog featured image upload:', [
                'filename' => $filename,
                'original_name' => $originalName,
                'size' => $fileSize,
                'mime' => $mimeType,
            ]);
            
            // Try storing in public directory first (simpler approach)
            try {
                $featuredImage->move(public_path('images/blog'), $filename);
                $data['featured_image'] = $filename;
                \Log::info('Blog featured image stored successfully in public directory: ' . $filename);
                
                // Create media file record
                MediaFile::create([
                    'filename' => $filename,
                    'original_filename' => $originalName,
                    'path' => 'images/blog/' . $filename,
                    'storage_type' => 'public',
                    'file_type' => 'image',
                    'file_size' => $fileSize,
                    'mime_type' => $mimeType,
                    'uploaded_by' => session('admin_id'),
                ]);
            } catch (\Exception $e) {
                \Log::error('Blog featured image upload failed: ' . $e->getMessage());
                // Don't set featured_image if upload failed
            }
        }
        
        \Log::info('Image upload processing completed, about to create blog post with data:', [
            'data' => $data,
            'data_keys' => array_keys($data)
        ]);
        
        try {
            $blogPost = BlogPost::create($data);
            
            \Log::info('Blog post created successfully', [
                'blog_post_id' => $blogPost->id,
                'title' => $blogPost->title,
                'status' => $blogPost->status
            ]);
        } catch (\Exception $e) {
            \Log::error('Blog post creation failed', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to create blog post: ' . $e->getMessage());
        }
        
        $message = 'Blog post created successfully.';
        $imagesUploaded = false;
        
        // Check if images were actually uploaded and stored
        if ($request->hasFile('featured_image') && isset($data['featured_image'])) {
            $imagesUploaded = true;
        }
        
        if ($imagesUploaded) {
            $message .= ' Featured image has been uploaded and will be visible after page refresh.';
        } else if ($request->hasFile('featured_image')) {
            $message .= ' Note: Featured image may not have uploaded successfully. Please check the logs for details.';
        }
        
        return redirect()->route('admin.blog-posts.index')
                       ->with('success', $message);
    }
    
    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog-posts.edit', compact('blogPost'));
    }
    
    public function update(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'required|string|max:100',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published,archived',
        ]);
        
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        // Convert tags from JSON string to array
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = json_decode($data['tags'], true);
        }
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old featured image
            if ($blogPost->featured_image) {
                $oldImagePath = public_path('images/blog/' . $blogPost->featured_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $featuredImage = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $featuredImage->getClientOriginalExtension();
            
            // Get file information BEFORE moving the file
            $originalName = $featuredImage->getClientOriginalName();
            $fileSize = $featuredImage->getSize();
            $mimeType = $featuredImage->getMimeType();
            
            \Log::info('Starting blog featured image update:', [
                'filename' => $filename,
                'original_name' => $originalName,
                'size' => $fileSize,
                'mime' => $mimeType,
            ]);
            
            // Try storing in public directory first (simpler approach)
            try {
                $featuredImage->move(public_path('images/blog'), $filename);
                $data['featured_image'] = $filename;
                \Log::info('Blog featured image updated successfully in public directory: ' . $filename);
                
                // Create media file record
                MediaFile::create([
                    'filename' => $filename,
                    'original_filename' => $originalName,
                    'path' => 'images/blog/' . $filename,
                    'storage_type' => 'public',
                    'file_type' => 'image',
                    'file_size' => $fileSize,
                    'mime_type' => $mimeType,
                    'uploaded_by' => session('admin_id'),
                ]);
            } catch (\Exception $e) {
                \Log::error('Blog featured image update failed: ' . $e->getMessage());
                // Don't set featured_image if upload failed
            }
        }
        
        $blogPost->update($data);
        
        $message = 'Blog post updated successfully.';
        $imagesUploaded = false;
        
        // Check if images were actually uploaded and stored
        if ($request->hasFile('featured_image') && isset($data['featured_image'])) {
            $imagesUploaded = true;
        }
        
        if ($imagesUploaded) {
            $message .= ' New featured image has been uploaded and will be visible after page refresh.';
        } else if ($request->hasFile('featured_image')) {
            $message .= ' Note: Featured image may not have uploaded successfully. Please check the logs for details.';
        }
        
        return redirect()->route('admin.blog-posts.index')
                       ->with('success', $message);
    }
    
    public function destroy(BlogPost $blogPost)
    {
        // Delete associated featured image
        if ($blogPost->featured_image) {
            $imagePath = public_path('images/blog/' . $blogPost->featured_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $blogPost->delete();
        
        return redirect()->route('admin.blog-posts.index')
                       ->with('success', 'Blog post deleted successfully.');
    }
    
    public function view(BlogPost $blogPost)
    {
        return response()->json([
            'success' => true,
            'blogPost' => [
                'id' => $blogPost->id,
                'title' => $blogPost->title,
                'excerpt' => $blogPost->excerpt,
                'content' => $blogPost->content,
                'category' => $blogPost->category,
                'tags' => $blogPost->tags,
                'meta_title' => $blogPost->meta_title,
                'meta_description' => $blogPost->meta_description,
                'status' => $blogPost->status,
                'featured_image_url' => $blogPost->featured_image_url,
                'created_at' => $blogPost->created_at->format('M d, Y'),
                'updated_at' => $blogPost->updated_at->format('M d, Y'),
            ]
        ]);
    }
}

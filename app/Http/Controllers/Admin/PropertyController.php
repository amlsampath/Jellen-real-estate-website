<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\MediaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by property type
        if ($request->filled('property_type')) {
            $query->where('property_type', $request->property_type);
        }
        
        $properties = $query->latest()->paginate(15);
        
        return view('admin.properties.index', compact('properties'));
    }
    
    public function create()
    {
        return view('admin.properties.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'property_type' => 'required|string|max:50',
            'property_category' => 'required|string|max:50',
            'listing_type' => 'required|in:For Sale,For Rent,For Lease',
            'price' => 'required|numeric|min:0',
            'price_currency' => 'required|string|max:10',
            'location' => 'required|string|max:255',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|numeric|min:0',
            'parking_spaces' => 'nullable|integer|min:0',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'amenities' => 'nullable|array',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive,sold,rented,pending',
            'featured' => 'boolean',
            'is_active' => 'boolean',
            'approved' => 'boolean',
        ]);
        
        $data = $request->all();
        $data['created_by'] = session('admin_id');
        
        // Debug: Log file upload information
        \Log::info('File upload debug:', [
            'has_featured_image' => $request->hasFile('featured_image'),
            'has_gallery_images' => $request->hasFile('gallery_images'),
            'featured_image_valid' => $request->hasFile('featured_image') ? $request->file('featured_image')->isValid() : false,
            'gallery_images_count' => $request->hasFile('gallery_images') ? count($request->file('gallery_images')) : 0,
        ]);
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $featuredImage->getClientOriginalExtension();
            
            // Get file information BEFORE moving the file
            $originalName = $featuredImage->getClientOriginalName();
            $fileSize = $featuredImage->getSize();
            $mimeType = $featuredImage->getMimeType();
            
            \Log::info('Starting featured image upload:', [
                'filename' => $filename,
                'original_name' => $originalName,
                'size' => $fileSize,
                'mime' => $mimeType,
            ]);
            
            // Try storing in public directory first (simpler approach)
            try {
                $featuredImage->move(public_path('images/properties'), $filename);
                $data['featured_image'] = $filename;
                \Log::info('Featured image stored successfully in public directory: ' . $filename);
                
                // Create media file record
                MediaFile::create([
                    'filename' => $filename,
                    'original_filename' => $originalName,
                    'path' => 'images/properties/' . $filename,
                    'storage_type' => 'public',
                    'file_type' => 'image',
                    'file_size' => $fileSize,
                    'mime_type' => $mimeType,
                    'uploaded_by' => session('admin_id'),
                ]);
            } catch (\Exception $e) {
                \Log::error('Featured image upload failed: ' . $e->getMessage());
                // Don't set featured_image if upload failed
            }
        }
        
        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                
                // Get file information BEFORE moving the file
                $originalName = $image->getClientOriginalName();
                $fileSize = $image->getSize();
                $mimeType = $image->getMimeType();
                
                \Log::info('Starting gallery image upload:', [
                    'filename' => $filename,
                    'original_name' => $originalName,
                    'size' => $fileSize,
                    'mime' => $mimeType,
                ]);
                
                // Try storing in public directory first (simpler approach)
                try {
                    $image->move(public_path('images/properties'), $filename);
                    $galleryImages[] = $filename;
                    \Log::info('Gallery image stored successfully in public directory: ' . $filename);
                    
                    // Create media file record
                    MediaFile::create([
                        'filename' => $filename,
                        'original_filename' => $originalName,
                        'path' => 'images/properties/' . $filename,
                        'storage_type' => 'public',
                        'file_type' => 'image',
                        'file_size' => $fileSize,
                        'mime_type' => $mimeType,
                        'uploaded_by' => session('admin_id'),
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Gallery image upload failed: ' . $e->getMessage());
                    // Don't add to gallery if upload failed
                }
            }
            $data['gallery_images'] = $galleryImages;
        }
        
        $property = Property::create($data);
        
        $message = 'Property created successfully.';
        $imagesUploaded = false;
        
        // Check if images were actually uploaded and stored
        $imagesUploaded = false;
        
        if ($request->hasFile('featured_image') && isset($data['featured_image'])) {
            $imagesUploaded = true;
        }
        
        if ($request->hasFile('gallery_images') && isset($data['gallery_images']) && count($data['gallery_images']) > 0) {
            $imagesUploaded = true;
        }
        
        if ($imagesUploaded) {
            $message .= ' Images have been uploaded and will be visible after page refresh.';
        } else if ($request->hasFile('featured_image') || $request->hasFile('gallery_images')) {
            $message .= ' Note: Some images may not have uploaded successfully. Please check the logs for details.';
        }
        
        return redirect()->route('admin.properties.index')
                       ->with('success', $message);
    }
    
    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }
    
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'property_type' => 'required|string|max:50',
            'property_category' => 'required|string|max:50',
            'listing_type' => 'required|in:For Sale,For Rent,For Lease',
            'price' => 'required|numeric|min:0',
            'price_currency' => 'required|string|max:10',
            'location' => 'required|string|max:255',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|numeric|min:0',
            'parking_spaces' => 'nullable|integer|min:0',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'amenities' => 'nullable|array',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive,sold,rented,pending',
            'featured' => 'boolean',
            'is_active' => 'boolean',
            'approved' => 'boolean',
        ]);
        
        $data = $request->all();
        
        // Debug: Log file upload information
        \Log::info('File upload debug (update):', [
            'has_featured_image' => $request->hasFile('featured_image'),
            'has_gallery_images' => $request->hasFile('gallery_images'),
            'featured_image_valid' => $request->hasFile('featured_image') ? $request->file('featured_image')->isValid() : false,
            'gallery_images_count' => $request->hasFile('gallery_images') ? count($request->file('gallery_images')) : 0,
        ]);
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old featured image
            if ($property->featured_image) {
                $oldImagePath = public_path('images/properties/' . $property->featured_image);
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
            
            \Log::info('Starting featured image update:', [
                'filename' => $filename,
                'original_name' => $originalName,
                'size' => $fileSize,
                'mime' => $mimeType,
            ]);
            
            // Try storing in public directory first (simpler approach)
            try {
                $featuredImage->move(public_path('images/properties'), $filename);
                $data['featured_image'] = $filename;
                \Log::info('Featured image updated successfully in public directory: ' . $filename);
                
                // Create media file record
                MediaFile::create([
                    'filename' => $filename,
                    'original_filename' => $originalName,
                    'path' => 'images/properties/' . $filename,
                    'storage_type' => 'public',
                    'file_type' => 'image',
                    'file_size' => $fileSize,
                    'mime_type' => $mimeType,
                    'uploaded_by' => session('admin_id'),
                ]);
            } catch (\Exception $e) {
                \Log::error('Featured image update failed: ' . $e->getMessage());
                // Don't set featured_image if upload failed
            }
        }
        
        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images
            if ($property->gallery_images) {
                foreach ($property->gallery_images as $oldImage) {
                    $oldImagePath = public_path('images/properties/' . $oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
            
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                
                // Get file information BEFORE moving the file
                $originalName = $image->getClientOriginalName();
                $fileSize = $image->getSize();
                $mimeType = $image->getMimeType();
                
                \Log::info('Starting gallery image update:', [
                    'filename' => $filename,
                    'original_name' => $originalName,
                    'size' => $fileSize,
                    'mime' => $mimeType,
                ]);
                
                // Try storing in public directory first (simpler approach)
                try {
                    $image->move(public_path('images/properties'), $filename);
                    $galleryImages[] = $filename;
                    \Log::info('Gallery image updated successfully in public directory: ' . $filename);
                    
                    // Create media file record
                    MediaFile::create([
                        'filename' => $filename,
                        'original_filename' => $originalName,
                        'path' => 'images/properties/' . $filename,
                        'storage_type' => 'public',
                        'file_type' => 'image',
                        'file_size' => $fileSize,
                        'mime_type' => $mimeType,
                        'uploaded_by' => session('admin_id'),
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Gallery image update failed: ' . $e->getMessage());
                    // Don't add to gallery if upload failed
                }
            }
            $data['gallery_images'] = $galleryImages;
        }
        
        $property->update($data);
        
        $message = 'Property updated successfully.';
        $imagesUploaded = false;
        
        // Check if images were actually uploaded and stored
        $imagesUploaded = false;
        
        if ($request->hasFile('featured_image') && isset($data['featured_image'])) {
            $imagesUploaded = true;
        }
        
        if ($request->hasFile('gallery_images') && isset($data['gallery_images']) && count($data['gallery_images']) > 0) {
            $imagesUploaded = true;
        }
        
        if ($imagesUploaded) {
            $message .= ' New images have been uploaded and will be visible after page refresh.';
        } else if ($request->hasFile('featured_image') || $request->hasFile('gallery_images')) {
            $message .= ' Note: Some images may not have uploaded successfully. Please check the logs for details.';
        }
        
        return redirect()->route('admin.properties.index')
                       ->with('success', $message);
    }
    
    public function destroy(Property $property)
    {
        // Delete associated images
        if ($property->featured_image) {
            Storage::delete('public/images/properties/' . $property->featured_image);
        }
        
        if ($property->gallery_images) {
            foreach ($property->gallery_images as $image) {
                Storage::delete('public/images/properties/' . $image);
            }
        }
        
        $property->delete();
        
        return redirect()->route('admin.properties.index')
                       ->with('success', 'Property deleted successfully.');
    }
    
    public function view(Property $property)
    {
        return response()->json([
            'success' => true,
            'property' => [
                'id' => $property->id,
                'title' => $property->title,
                'description' => $property->description,
                'property_type' => $property->property_type,
                'property_category' => $property->property_category,
                'listing_type' => $property->listing_type,
                'price' => $property->price,
                'price_currency' => $property->price_currency,
                'location' => $property->location,
                'bedrooms' => $property->bedrooms,
                'bathrooms' => $property->bathrooms,
                'area' => $property->area,
                'parking_spaces' => $property->parking_spaces,
                'amenities' => $property->amenities,
                'city' => $property->city,
                'state' => $property->state,
                'postal_code' => $property->postal_code,
                'status' => $property->status,
                'featured_image_url' => $property->featured_image_url,
                'gallery_image_urls' => $property->gallery_image_urls,
                'created_at' => $property->created_at->format('M d, Y'),
            ]
        ]);
    }
}

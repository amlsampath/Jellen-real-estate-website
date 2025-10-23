<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::published()
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $featuredPost = BlogPost::published()
            ->orderBy('views', 'desc')
            ->first();

        $recentPosts = BlogPost::published()
            ->recent(3)
            ->get();

        return view('blog.index', compact('blogPosts', 'featuredPost', 'recentPosts'));
    }

    public function show($slug)
    {
        $post = BlogPost::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count
        $post->increment('views');

        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->recent(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function category($category)
    {
        $blogPosts = BlogPost::published()
            ->where('category', $category)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('blog.category', compact('blogPosts', 'category'));
    }
}

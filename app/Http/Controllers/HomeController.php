<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Statistic;
use App\Models\Award;
use App\Models\Service;
use App\Models\BlogPost;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured properties
        $featuredProperties = Property::active()
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        // Get statistics
        $statistics = Statistic::ordered()->take(4)->get();

        // Get services
        $services = Service::active()->ordered()->get();

        // Get awards
        $awards = Award::ordered()->get();

        // Get team members
        $teamMembers = TeamMember::featured()->ordered()->take(3)->get();

        // Get testimonials
        $testimonials = Testimonial::featured()->take(3)->get();

        // Get recent blog posts
        $blogPosts = BlogPost::published()
            ->recent(3)
            ->get();

        // Get selling properties from database
        $sellingProperties = Property::where('listing_type', 'For Sale')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('home', compact(
            'featuredProperties',
            'statistics',
            'services',
            'awards',
            'teamMembers',
            'testimonials',
            'sellingProperties',
            'blogPosts'
        ));
    }
}

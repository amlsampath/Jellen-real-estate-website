<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Statistic;
use App\Models\Award;
use App\Models\Service;

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

        // Get selling properties data
        $sellingProperties = [
            [
                'id' => 1,
                'title' => 'Modern Family Home',
                'image' => 'property-1.jpg',
                'location' => 'Western Australia',
                'capital_growth' => '29.75',
                'purchased_price' => '$447,000',
                'date_purchased' => 'October 2024',
                'date_of_value' => 'July 2025',
                'cash_on_cash_return' => '156.47',
                'current_value' => '$580,000'
            ],
            [
                'id' => 2,
                'title' => 'Contemporary Investment Property',
                'image' => 'property-2.jpg',
                'location' => 'Western Australia',
                'capital_growth' => '33.65',
                'purchased_price' => '$520,000',
                'date_purchased' => 'September 25, 2023',
                'date_of_value' => 'July 2025',
                'cash_on_cash_return' => '205.88',
                'current_value' => '$695,000'
            ],
            [
                'id' => 3,
                'title' => 'Premium Investment Property',
                'image' => 'property-3.jpg',
                'location' => 'Western Australia',
                'capital_growth' => '37.78',
                'purchased_price' => '$450,000',
                'date_purchased' => 'September 2023',
                'date_of_value' => 'July 2025',
                'cash_on_cash_return' => '200.00',
                'current_value' => '$620,000'
            ]
        ];

        return view('home', compact(
            'featuredProperties',
            'statistics',
            'services',
            'awards',
            'teamMembers',
            'testimonials',
            'sellingProperties'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellingPropertiesController extends Controller
{
    public function index()
    {
        $sellingProperties = [
            [
                'id' => 1,
                'title' => 'Modern Family Home',
                'image' => 'ecoprops-slide-1.jpg',
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
                'image' => 'kelsey-collage.jpg',
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
                'image' => 'kelsey-collage.jpg',
                'location' => 'Western Australia',
                'capital_growth' => '37.78',
                'purchased_price' => '$450,000',
                'date_purchased' => 'September 2023',
                'date_of_value' => 'July 2025',
                'cash_on_cash_return' => '200.00',
                'current_value' => '$620,000'
            ]
        ];

        return view('selling-properties', compact('sellingProperties'));
    }
}
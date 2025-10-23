<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::active();

        // Filter by property type
        if ($request->filled('type')) {
            $query->where('property_type', $request->type);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by bedrooms
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

        // Filter by bathrooms
        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', '>=', $request->bathrooms);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Sort options
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        switch ($sortBy) {
            case 'price':
                $query->orderBy('price', $sortDirection);
                break;
            case 'title':
                $query->orderBy('title', $sortDirection);
                break;
            default:
                $query->orderBy('created_at', $sortDirection);
        }

        $properties = $query->paginate(12);

        return view('properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        // Get related properties (same type, different property)
        $relatedProperties = Property::active()
            ->where('property_type', $property->property_type)
            ->where('id', '!=', $property->id)
            ->take(4)
            ->get();

        return view('properties.show', compact('property', 'relatedProperties'));
    }
}

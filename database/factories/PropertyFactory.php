<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $propertyTypes = ['sale', 'rent', 'lease'];
        $propertyType = fake()->randomElement($propertyTypes);
        
        $locations = [
            'Downtown Manhattan, NY',
            'Beverly Hills, CA',
            'Miami Beach, FL',
            'Austin, TX',
            'Seattle, WA',
            'Chicago, IL',
            'Boston, MA',
            'San Francisco, CA'
        ];

        return [
            'title' => fake()->randomElement([
                'Luxury Modern Villa',
                'Contemporary Downtown Loft',
                'Historic Brownstone',
                'Penthouse with City Views',
                'Waterfront Estate',
                'Mountain View Cabin',
                'Urban Townhouse',
                'Beachfront Condo'
            ]),
            'description' => fake()->paragraphs(3, true),
            'property_type' => $propertyType,
            'price' => fake()->numberBetween(300000, 5000000),
            'location' => fake()->randomElement($locations),
            'bedrooms' => fake()->numberBetween(1, 6),
            'bathrooms' => fake()->numberBetween(1, 5),
            'area' => fake()->numberBetween(800, 8000),
            'featured_image' => 'properties/property-' . fake()->numberBetween(1, 20) . '.jpg',
            'gallery_images' => [
                'properties/gallery-' . fake()->numberBetween(1, 20) . '.jpg',
                'properties/gallery-' . fake()->numberBetween(1, 20) . '.jpg',
                'properties/gallery-' . fake()->numberBetween(1, 20) . '.jpg'
            ],
            'status' => fake()->randomElement(['active', 'active', 'active', 'sold', 'rented']),
            'featured' => fake()->boolean(20) // 20% chance of being featured
        ];
    }
}

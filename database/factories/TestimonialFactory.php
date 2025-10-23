<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = [
            'Property Investor',
            'First-time Home Buyer',
            'Real Estate Developer',
            'Business Owner',
            'Retiree',
            'Young Professional',
            'Family of Four',
            'Real Estate Agent'
        ];

        $testimonials = [
            'Working with this team was absolutely incredible. They found us the perfect investment property that has already appreciated 25% in just two years.',
            'The level of expertise and market knowledge is unmatched. They helped us navigate a complex commercial lease negotiation.',
            'From start to finish, the process was seamless. They understood exactly what we were looking for and delivered beyond our expectations.',
            'Their attention to detail and commitment to finding the right property saved us thousands of dollars and months of searching.',
            'The team\'s local market knowledge and network of contacts gave us access to properties we never would have found on our own.',
            'Professional, responsive, and results-driven. They helped us build a portfolio of rental properties that generates excellent returns.',
            'The investment strategy they recommended has outperformed all our expectations. We couldn\'t be happier with the results.',
            'Their expertise in luxury properties is second to none. They found us our dream home in a competitive market.'
        ];

        return [
            'client_name' => fake()->name(),
            'client_role' => fake()->randomElement($roles),
            'content' => fake()->randomElement($testimonials),
            'rating' => fake()->numberBetween(4, 5),
            'image' => 'testimonials/client-' . fake()->numberBetween(1, 10) . '.jpg',
            'featured' => fake()->boolean(30) // 30% chance of being featured
        ];
    }
}

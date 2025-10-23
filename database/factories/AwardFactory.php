<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Award>
 */
class AwardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $awards = [
            ['title' => 'Best Real Estate Agency', 'year' => 2024, 'category' => 'Industry Recognition'],
            ['title' => 'Top Investment Property Specialist', 'year' => 2024, 'category' => 'Professional Excellence'],
            ['title' => 'Client Choice Award', 'year' => 2023, 'category' => 'Customer Service'],
            ['title' => 'Innovation in Real Estate', 'year' => 2023, 'category' => 'Technology'],
            ['title' => 'Rising Star Award', 'year' => 2023, 'category' => 'Emerging Talent'],
            ['title' => 'Excellence in Commercial Real Estate', 'year' => 2022, 'category' => 'Commercial'],
            ['title' => 'Luxury Property Expert', 'year' => 2022, 'category' => 'Luxury Market'],
            ['title' => 'Community Impact Award', 'year' => 2022, 'category' => 'Social Responsibility']
        ];

        $award = fake()->randomElement($awards);

        return [
            'title' => $award['title'],
            'year' => $award['year'],
            'category' => $award['category'],
            'image' => 'awards/award-' . fake()->numberBetween(1, 8) . '.jpg',
            'order' => fake()->numberBetween(1, 10)
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistic>
 */
class StatisticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statistics = [
            ['label' => 'Properties Sold', 'value' => '1,250+', 'suffix' => '', 'description' => 'Successful property transactions completed'],
            ['label' => 'Client Satisfaction', 'value' => '98', 'suffix' => '%', 'description' => 'Client satisfaction rate based on reviews'],
            ['label' => 'Average ROI', 'value' => '12.5', 'suffix' => '%', 'description' => 'Average return on investment for our clients'],
            ['label' => 'Years Experience', 'value' => '15+', 'suffix' => '', 'description' => 'Years of combined team experience'],
            ['label' => 'Properties Under Management', 'value' => '500+', 'suffix' => '', 'description' => 'Active properties in our portfolio'],
            ['label' => 'Market Coverage', 'value' => '25+', 'suffix' => ' Cities', 'description' => 'Cities where we operate'],
            ['label' => 'Investment Volume', 'value' => '$2.5B+', 'suffix' => '', 'description' => 'Total investment volume facilitated'],
            ['label' => 'Team Members', 'value' => '50+', 'suffix' => '', 'description' => 'Expert real estate professionals']
        ];

        $stat = fake()->randomElement($statistics);

        return [
            'label' => $stat['label'],
            'value' => $stat['value'],
            'suffix' => $stat['suffix'],
            'description' => $stat['description'],
            'order' => fake()->numberBetween(1, 10)
        ];
    }
}

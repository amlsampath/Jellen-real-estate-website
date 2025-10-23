<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $services = [
            [
                'title' => 'Property Investment Consulting',
                'description' => 'Expert guidance on building a profitable real estate investment portfolio with strategic property selection and market analysis.',
                'icon' => 'investment',
                'features' => ['Market Analysis', 'ROI Calculations', 'Risk Assessment', 'Portfolio Diversification']
            ],
            [
                'title' => 'Luxury Property Sales',
                'description' => 'Specialized services for high-end residential and commercial properties with exclusive market access and premium marketing.',
                'icon' => 'luxury',
                'features' => ['Exclusive Listings', 'Premium Marketing', 'Private Showings', 'Concierge Service']
            ],
            [
                'title' => 'Commercial Real Estate',
                'description' => 'Comprehensive commercial real estate services including office, retail, and industrial property transactions.',
                'icon' => 'commercial',
                'features' => ['Lease Negotiations', 'Property Valuation', 'Market Research', 'Transaction Management']
            ],
            [
                'title' => 'Property Management',
                'description' => 'Full-service property management including tenant screening, maintenance coordination, and financial reporting.',
                'icon' => 'management',
                'features' => ['Tenant Relations', 'Maintenance', 'Financial Reporting', 'Legal Compliance']
            ]
        ];

        $service = fake()->randomElement($services);

        return [
            'title' => $service['title'],
            'description' => $service['description'],
            'icon' => $service['icon'],
            'features' => $service['features'],
            'order' => fake()->numberBetween(1, 10),
            'active' => true
        ];
    }
}

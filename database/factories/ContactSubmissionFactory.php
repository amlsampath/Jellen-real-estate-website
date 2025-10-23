<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactSubmission>
 */
class ContactSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $interests = [
            'Investment Properties',
            'Luxury Homes',
            'Commercial Real Estate',
            'Property Management',
            'First-time Buying',
            'Selling My Property',
            'Market Analysis',
            'Portfolio Review'
        ];

        $messages = [
            'I\'m interested in learning more about your investment property services. Could you provide information about your current listings?',
            'Looking to purchase my first investment property. Would like to schedule a consultation to discuss my options.',
            'I have a commercial property I\'m considering selling. Can you provide a market analysis and valuation?',
            'Interested in your property management services. I have several rental properties that need professional management.',
            'Would like to discuss building a real estate investment portfolio. What services do you offer for new investors?',
            'I\'m selling my luxury home and need expert representation. What makes your agency different?',
            'Looking for commercial space for my business. Do you have any office or retail properties available?',
            'Interested in your market analysis services. I\'m considering several investment opportunities.'
        ];

        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'message' => fake()->randomElement($messages),
            'property_interest' => fake()->randomElement($interests),
            'read' => fake()->boolean(70) // 70% chance of being read
        ];
    }
}

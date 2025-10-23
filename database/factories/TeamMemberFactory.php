<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamMember>
 */
class TeamMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = [
            'Senior Real Estate Advisor',
            'Investment Property Specialist',
            'Luxury Property Consultant',
            'Commercial Real Estate Expert',
            'Property Investment Analyst',
            'Real Estate Portfolio Manager',
            'Market Research Specialist',
            'Client Relations Director'
        ];

        $bios = [
            'With over 15 years of experience in real estate investment, Sarah specializes in identifying high-yield properties in emerging markets.',
            'John brings 20+ years of commercial real estate expertise, having closed over $500M in transactions across major metropolitan areas.',
            'As a certified investment advisor, Michael helps clients build diversified real estate portfolios that generate consistent returns.',
            'Lisa\'s background in market analysis and property valuation ensures clients make informed investment decisions.',
            'With a focus on luxury properties, David has built a reputation for securing exclusive listings in prime locations.',
            'Emma\'s expertise in property management and tenant relations helps clients maximize their rental income.',
            'As a former developer, Robert provides unique insights into property development opportunities and market trends.',
            'Jennifer\'s client-first approach and attention to detail have earned her recognition as a top-performing agent.'
        ];

        return [
            'name' => fake()->name(),
            'role' => fake()->randomElement($roles),
            'bio' => fake()->randomElement($bios),
            'image' => 'team/member-' . fake()->numberBetween(1, 15) . '.jpg',
            'social_links' => [
                'linkedin' => 'https://linkedin.com/in/' . fake()->slug(),
                'twitter' => 'https://twitter.com/' . fake()->userName(),
                'email' => fake()->email()
            ],
            'order' => fake()->numberBetween(1, 10),
            'featured' => fake()->boolean(40) // 40% chance of being featured
        ];
    }
}

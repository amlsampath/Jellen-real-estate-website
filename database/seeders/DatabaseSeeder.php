<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Statistic;
use App\Models\Award;
use App\Models\Service;
use App\Models\ContactSubmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@realestate.com',
        ]);

        // Seed statistics (4 key stats for homepage)
        Statistic::factory()->create([
            'label' => 'Properties Sold',
            'value' => '1,250+',
            'suffix' => '',
            'description' => 'Successful property transactions completed',
            'order' => 1
        ]);

        Statistic::factory()->create([
            'label' => 'Client Satisfaction',
            'value' => '98',
            'suffix' => '%',
            'description' => 'Client satisfaction rate based on reviews',
            'order' => 2
        ]);

        Statistic::factory()->create([
            'label' => 'Average ROI',
            'value' => '12.5',
            'suffix' => '%',
            'description' => 'Average return on investment for our clients',
            'order' => 3
        ]);

        Statistic::factory()->create([
            'label' => 'Years Experience',
            'value' => '15+',
            'suffix' => '',
            'description' => 'Years of combined team experience',
            'order' => 4
        ]);

        // Seed services
        Service::factory()->create([
            'title' => 'Property Investment Consulting',
            'description' => 'Expert guidance on building a profitable real estate investment portfolio with strategic property selection and market analysis.',
            'icon' => 'investment',
            'features' => ['Market Analysis', 'ROI Calculations', 'Risk Assessment', 'Portfolio Diversification'],
            'order' => 1
        ]);

        Service::factory()->create([
            'title' => 'Luxury Property Sales',
            'description' => 'Specialized services for high-end residential and commercial properties with exclusive market access and premium marketing.',
            'icon' => 'luxury',
            'features' => ['Exclusive Listings', 'Premium Marketing', 'Private Showings', 'Concierge Service'],
            'order' => 2
        ]);

        Service::factory()->create([
            'title' => 'Commercial Real Estate',
            'description' => 'Comprehensive commercial real estate services including office, retail, and industrial property transactions.',
            'icon' => 'commercial',
            'features' => ['Lease Negotiations', 'Property Valuation', 'Market Research', 'Transaction Management'],
            'order' => 3
        ]);

        Service::factory()->create([
            'title' => 'Property Management',
            'description' => 'Full-service property management including tenant screening, maintenance coordination, and financial reporting.',
            'icon' => 'management',
            'features' => ['Tenant Relations', 'Maintenance', 'Financial Reporting', 'Legal Compliance'],
            'order' => 4
        ]);

        // Seed awards
        Award::factory()->create([
            'title' => 'Best Real Estate Agency 2024',
            'year' => 2024,
            'category' => 'Industry Recognition',
            'order' => 1
        ]);

        Award::factory()->create([
            'title' => 'Top Investment Property Specialist 2024',
            'year' => 2024,
            'category' => 'Professional Excellence',
            'order' => 2
        ]);

        Award::factory()->create([
            'title' => 'Client Choice Award 2023',
            'year' => 2023,
            'category' => 'Customer Service',
            'order' => 3
        ]);

        Award::factory()->create([
            'title' => 'Innovation in Real Estate 2023',
            'year' => 2023,
            'category' => 'Technology',
            'order' => 4
        ]);

            // Seed team members with real images
            TeamMember::factory()->create([
                'name' => 'Sarah Johnson',
                'role' => 'Founder & CEO',
                'bio' => 'With over 15 years of experience in real estate investment, Sarah founded the company with a vision to help clients build wealth through strategic property investments.',
                'image' => 'team/sarah-johnson.jpg',
                'social_links' => [
                    'linkedin' => 'https://linkedin.com/in/sarah-johnson',
                    'twitter' => 'https://twitter.com/sarahjohnson',
                    'email' => 'sarah@realestate.com'
                ],
                'order' => 1,
                'featured' => true
            ]);

            TeamMember::factory()->create([
                'name' => 'Michael Chen',
                'role' => 'Senior Investment Advisor',
                'bio' => 'Michael brings 20+ years of commercial real estate expertise, having closed over $500M in transactions across major metropolitan areas.',
                'image' => 'team/michael-chen.jpg',
                'social_links' => [
                    'linkedin' => 'https://linkedin.com/in/michael-chen',
                    'twitter' => 'https://twitter.com/michaelchen',
                    'email' => 'michael@realestate.com'
                ],
                'order' => 2,
                'featured' => true
            ]);

            TeamMember::factory()->create([
                'name' => 'Lisa Rodriguez',
                'role' => 'Luxury Property Specialist',
                'bio' => 'Lisa\'s background in market analysis and property valuation ensures clients make informed investment decisions in the luxury market.',
                'image' => 'team/lisa-rodriguez.jpg',
                'social_links' => [
                    'linkedin' => 'https://linkedin.com/in/lisa-rodriguez',
                    'twitter' => 'https://twitter.com/lisarodriguez',
                    'email' => 'lisa@realestate.com'
                ],
                'order' => 3,
                'featured' => true
            ]);

        // Seed additional team members
        TeamMember::factory(5)->create();

        // Seed testimonials with real client images
        Testimonial::factory()->create([
            'client_name' => 'David Thompson',
            'client_role' => 'Property Investor',
            'content' => 'Working with this team was absolutely incredible. They found us the perfect investment property that has already appreciated 25% in just two years.',
            'rating' => 5,
            'image' => 'testimonials/client-1.jpg',
            'featured' => true
        ]);

        Testimonial::factory()->create([
            'client_name' => 'Jennifer Martinez',
            'client_role' => 'First-time Home Buyer',
            'content' => 'The level of expertise and market knowledge is unmatched. They helped us navigate a complex commercial lease negotiation.',
            'rating' => 5,
            'image' => 'testimonials/client-2.jpg',
            'featured' => true
        ]);

        Testimonial::factory()->create([
            'client_name' => 'Robert Wilson',
            'client_role' => 'Real Estate Developer',
            'content' => 'From start to finish, the process was seamless. They understood exactly what we were looking for and delivered beyond our expectations.',
            'rating' => 5,
            'image' => 'testimonials/client-3.jpg',
            'featured' => true
        ]);

        // Seed additional testimonials
        Testimonial::factory(7)->create();

        // Seed properties with real images
        Property::factory()->create([
            'title' => 'Luxury Modern Villa',
            'description' => 'Stunning contemporary villa with panoramic city views, featuring 5 bedrooms, 4 bathrooms, and a private pool.',
            'property_type' => 'sale',
            'price' => 2500000,
            'location' => 'Beverly Hills, CA',
            'bedrooms' => 5,
            'bathrooms' => 4,
            'area' => 4500,
            'featured_image' => 'properties/property-1.jpg',
            'gallery_images' => ['properties/property-1.jpg', 'properties/property-2.jpg'],
            'status' => 'active',
            'featured' => true
        ]);

        Property::factory()->create([
            'title' => 'Downtown Penthouse',
            'description' => 'Exclusive penthouse with 360-degree city views, modern amenities, and premium finishes throughout.',
            'property_type' => 'sale',
            'price' => 1800000,
            'location' => 'Manhattan, NY',
            'bedrooms' => 3,
            'bathrooms' => 3,
            'area' => 2800,
            'featured_image' => 'properties/property-2.jpg',
            'gallery_images' => ['properties/property-2.jpg', 'properties/property-3.jpg'],
            'status' => 'active',
            'featured' => true
        ]);

        Property::factory()->create([
            'title' => 'Beachfront Condo',
            'description' => 'Oceanfront luxury condo with direct beach access, resort-style amenities, and breathtaking sunset views.',
            'property_type' => 'rent',
            'price' => 8500,
            'location' => 'Miami Beach, FL',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'area' => 1800,
            'featured_image' => 'properties/property-3.jpg',
            'gallery_images' => ['properties/property-3.jpg', 'properties/property-4.jpg'],
            'status' => 'active',
            'featured' => true
        ]);

        Property::factory()->create([
            'title' => 'Historic Brownstone',
            'description' => 'Beautifully restored historic brownstone with original architectural details and modern updates.',
            'property_type' => 'sale',
            'price' => 1200000,
            'location' => 'Brooklyn, NY',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'area' => 3200,
            'featured_image' => 'properties/property-4.jpg',
            'gallery_images' => ['properties/property-4.jpg', 'properties/property-5.jpg'],
            'status' => 'active',
            'featured' => true
        ]);

        // Seed additional properties
        Property::factory(16)->create();

        // Seed contact submissions
        ContactSubmission::factory(15)->create();

        // Seed admin user
        $this->call([
            AdminSeeder::class,
            InquirySeeder::class,
        ]);
    }
}

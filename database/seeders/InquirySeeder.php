<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyInquiry;
use App\Models\Property;

class InquirySeeder extends Seeder
{
    public function run(): void
    {
        // Get the first property to associate inquiries with
        $property = Property::first();
        
        if (!$property) {
            $this->command->info('No properties found. Please create a property first.');
            return;
        }
        
        // Create sample inquiries
        $inquiries = [
            [
                'property_id' => $property->id,
                'name' => 'John Smith',
                'email' => 'john.smith@email.com',
                'phone' => '+61 412 345 678',
                'message' => 'Hi, I\'m interested in viewing this property. Could you please arrange a viewing for this weekend? I\'m particularly interested in the garden area and the kitchen layout.',
                'inquiry_type' => 'viewing',
                'status' => 'new',
            ],
            [
                'property_id' => $property->id,
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@email.com',
                'phone' => '+61 423 456 789',
                'message' => 'Hello, I would like to know more about the property taxes and any additional costs associated with this property. Also, what is the neighborhood like?',
                'inquiry_type' => 'information',
                'status' => 'contacted',
            ],
            [
                'property_id' => $property->id,
                'name' => 'Michael Brown',
                'email' => 'michael.brown@email.com',
                'phone' => '+61 434 567 890',
                'message' => 'I\'m very interested in this property and would like to make an offer. What is the best way to proceed? I\'m pre-approved for a loan and ready to move quickly.',
                'inquiry_type' => 'offer',
                'status' => 'new',
            ],
            [
                'property_id' => $property->id,
                'name' => 'Emma Wilson',
                'email' => 'emma.wilson@email.com',
                'phone' => '+61 445 678 901',
                'message' => 'Could you please provide more information about the property\'s history and any recent renovations? I\'m also interested in the energy efficiency rating.',
                'inquiry_type' => 'information',
                'status' => 'closed',
            ],
            [
                'property_id' => $property->id,
                'name' => 'David Lee',
                'email' => 'david.lee@email.com',
                'phone' => '+61 456 789 012',
                'message' => 'I\'d like to schedule a viewing for next week. Are there any specific times that work best? I\'m available most weekdays after 5 PM.',
                'inquiry_type' => 'viewing',
                'status' => 'contacted',
            ],
        ];
        
        foreach ($inquiries as $inquiryData) {
            PropertyInquiry::create($inquiryData);
        }
        
        $this->command->info('Created ' . count($inquiries) . ' sample inquiries.');
    }
}
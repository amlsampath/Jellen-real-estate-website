<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AgentContact;

class AgentContactSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        AgentContact::create([
            'name' => 'Sarah Johnson',
            'title' => 'Senior Real Estate Advisor',
            'email' => 'sarah@govenerrealty.com',
            'mobile_number' => '+61 400 123 456',
            'whatsapp_number' => '+61400123456',
            'bio' => 'With over 10 years of experience in real estate, Sarah specializes in helping clients find their dream homes and investment properties. She is committed to providing exceptional service and building lasting relationships with her clients.',
            'photo' => 'agent-sarah.jpg',
            'is_active' => true,
        ]);
    }
}
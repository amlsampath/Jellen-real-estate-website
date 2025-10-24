<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the existing property to use existing images
        $property = \App\Models\Property::first();
        if ($property) {
            $property->featured_image = 'property-1.jpg';
            $property->gallery_images = ['property-2.jpg', 'property-3.jpg'];
            $property->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

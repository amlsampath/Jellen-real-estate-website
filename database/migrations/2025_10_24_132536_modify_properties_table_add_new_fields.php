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
        Schema::table('properties', function (Blueprint $table) {
            // Change property_type from enum to varchar
            $table->string('property_type', 50)->change();
            
            // Add new fields
            $table->string('property_category', 50)->nullable();
            $table->enum('listing_type', ['For Sale', 'For Rent', 'For Lease'])->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('price_currency', 10)->default('AUD');
            $table->integer('parking_spaces')->nullable();
            $table->json('amenities')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('country', 100)->default('Australia');
            $table->boolean('is_active')->default(true);
            $table->boolean('approved')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            
            // Modify status enum to include 'pending'
            $table->enum('status', ['active', 'inactive', 'sold', 'rented', 'pending'])->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

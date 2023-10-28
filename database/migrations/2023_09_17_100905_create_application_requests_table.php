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
        Schema::create('application_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_type_id');
            $table->foreignId('phase_id');
            $table->foreignId('country_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->text('address')->nullable();
            $table->text('building_or_business_name')->nullable();
            $table->text('street_address')->nullable();
            $table->text('city')->nullable();
            $table->text('district')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('deed_number')->nullable();
            $table->string('plot_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_requests');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationsTable extends Migration
{
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('property_type');
            $table->integer('property_size');
            $table->string('property_size_unit');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('residents');
            $table->text('description')->nullable();
            $table->text('neighborhood')->nullable();
            $table->string('address');
            $table->string('zip');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->float('lat');
            $table->float('lng');
            $table->json('amenities')->nullable();
            $table->string('3d_tour')->nullable();
            $table->json('property_photos')->nullable();
            $table->string('check_in_earliest')->nullable();
            $table->string('check_in_latest')->nullable();
            $table->string('check_in_contact')->nullable();
            $table->text('check_in_instructions')->nullable();
            $table->text('directions')->nullable();
            $table->text('house_manual')->nullable();
            $table->string('check_in_phone_code')->nullable();
            $table->string('check_in_phone_number')->nullable();
            $table->timestamps(); // Laravel's created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('accommodations');
    }
}

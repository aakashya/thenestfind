<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->string('id')->primary(); // API Room ID (not auto-increment)
            $table->foreignId('accommodation_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('room_type');
            $table->integer('room_size');
            $table->string('room_size_unit');
            $table->integer('max_occupancy');
            $table->string('bathroom_type');
            $table->text('description')->nullable();
            $table->json('prices')->nullable();
            $table->json('amenities')->nullable();
            $table->date('available_at')->nullable();
            $table->json('photos')->nullable();
            $table->string('application_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}


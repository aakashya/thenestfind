<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('full_name'); // User's Full Name
            $table->string('email'); // User's Email
            $table->string('country_code')->nullable(); // Country Code
            $table->string('phone_number'); // User's Phone Number
            $table->string('accommodation_id'); // Stored as a String
            $table->string('accommodation_name'); // Accommodation Name
            $table->string('room_name')->nullable(); // Room Name
            $table->string('room_duration')->nullable(); // Booking Duration
            $table->string('room_price')->nullable(); // Room Price (Now String)
            $table->text('message')->nullable(); // User's Message
            $table->string('submission_url'); // URL where form was submitted
            $table->string('provider')->nullable(); // Accommodation Provider
            $table->timestamps(); // Created & updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_submissions');
    }
};

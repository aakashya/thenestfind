<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->integer('price')->nullable()->after('accommodation_id'); // New price column
            $table->string('unit')->nullable()->after('price'); // Unit number
            $table->boolean('private_bathroom')->default(0)->after('unit'); // Private bathroom
            $table->integer('number_of_roommates')->nullable()->after('private_bathroom'); // Number of roommates
            $table->boolean('live_in_partner_allowed')->default(0)->after('number_of_roommates'); // Live-in partner allowed
            $table->string('price_frequency')->nullable()->after('live_in_partner_allowed'); // Price frequency (monthly, yearly, etc.)
            $table->text('terms')->nullable()->after('price_frequency'); // Terms of rental
            $table->string('room_info')->nullable()->after('terms'); // Room information
            $table->string('room_url')->nullable()->after('room_info'); // Room URL
            $table->string('virtual_tour_url')->nullable()->after('room_url'); // Virtual tour URL
            $table->string('provider')->nullable()->after('virtual_tour_url'); // Provider column
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn([
                'price', 'unit', 'private_bathroom', 'number_of_roommates', 
                'live_in_partner_allowed', 'price_frequency', 'terms', 'room_info', 
                'room_url', 'virtual_tour_url', 'provider'
            ]);
        });
    }
};


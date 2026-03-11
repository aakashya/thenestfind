<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'price')) {
                $table->integer('price')->nullable()->after('accommodation_id'); // New price column
            }
            if (!Schema::hasColumn('rooms', 'unit')) {
                $table->string('unit')->nullable()->after('price'); // Unit number
            }
            if (!Schema::hasColumn('rooms', 'private_bathroom')) {
                $table->boolean('private_bathroom')->default(0)->after('unit'); // Private bathroom
            }
            if (!Schema::hasColumn('rooms', 'number_of_roommates')) {
                $table->integer('number_of_roommates')->nullable()->after('private_bathroom'); // Number of roommates
            }
            if (!Schema::hasColumn('rooms', 'live_in_partner_allowed')) {
                $table->boolean('live_in_partner_allowed')->default(0)->after('number_of_roommates'); // Live-in partner allowed
            }
            if (!Schema::hasColumn('rooms', 'price_frequency')) {
                $table->string('price_frequency')->nullable()->after('live_in_partner_allowed'); // Price frequency (monthly, yearly, etc.)
            }
            if (!Schema::hasColumn('rooms', 'terms')) {
                $table->text('terms')->nullable()->after('price_frequency'); // Terms of rental
            }
            if (!Schema::hasColumn('rooms', 'room_info')) {
                $table->string('room_info')->nullable()->after('terms'); // Room information
            }
            if (!Schema::hasColumn('rooms', 'room_url')) {
                $table->string('room_url')->nullable()->after('room_info'); // Room URL
            }
            if (!Schema::hasColumn('rooms', 'virtual_tour_url')) {
                $table->string('virtual_tour_url')->nullable()->after('room_url'); // Virtual tour URL
            }
            if (!Schema::hasColumn('rooms', 'provider')) {
                $table->string('provider')->nullable()->after('virtual_tour_url'); // Provider column
            }
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $columns = [
                'price', 'unit', 'private_bathroom', 'number_of_roommates',
                'live_in_partner_allowed', 'price_frequency', 'terms', 'room_info',
                'room_url', 'virtual_tour_url', 'provider',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('rooms', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

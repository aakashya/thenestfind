<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->text('terms')->nullable()->after('amenities'); // Add `terms` column
            $table->string('street')->nullable()->after('terms'); // Add `street` column
        });
    }

    public function down()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->dropColumn('terms');
            $table->dropColumn('street');
        });
    }
};
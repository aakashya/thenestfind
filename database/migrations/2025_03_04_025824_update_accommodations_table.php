<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->dropColumn('partner'); // Remove the 'partner' column
            $table->string('provider')->nullable()->after('street'); // Add 'provider' column
        });
    }

    public function down()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->string('partner')->nullable(); // Re-add 'partner' column in case of rollback
            $table->dropColumn('provider'); // Remove 'provider' column in rollback
        });
    }
};

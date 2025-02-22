<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddPartnerToAccommodationsTable extends Migration
{
    public function up()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            // Add the partner column with a default value
            $table->string('partner')->default('June Homes');
        });

        // Update existing rows in case they need the default value set explicitly
        DB::table('accommodations')->update(['partner' => 'June Homes']);
    }

    public function down()
    {
        Schema::table('accommodations', function (Blueprint $table) {
            $table->dropColumn('partner');
        });
    }
}



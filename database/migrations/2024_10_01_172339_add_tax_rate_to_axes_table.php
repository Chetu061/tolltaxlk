<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxRateToAxesTable extends Migration
{
    public function up()
    {
        Schema::table('axes', function (Blueprint $table) {
            $table->decimal('tax_rate', 8, 2)->nullable(); // Add tax_rate column
        });
    }

    public function down()
    {
        Schema::table('axes', function (Blueprint $table) {
            $table->dropColumn('tax_rate'); // Drop the tax_rate column if rollback is needed
        });
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('sales', function (Blueprint $table) {
        $table->dropColumn('quantity_sold'); // Remove quantity_sold
    });
}

public function down()
{
    Schema::table('sales', function (Blueprint $table) {
        $table->integer('quantity_sold')->default(0); // Add back if needed
    });
}

};

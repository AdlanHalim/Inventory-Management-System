<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->integer('quantity_sold')->default(0)->change(); // Modify column to have a default
        });
    }
    
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->integer('quantity_sold')->change(); // Revert changes if necessary
        });
    }
    
};

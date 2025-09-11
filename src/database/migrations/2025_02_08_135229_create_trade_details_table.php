<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trade_details', function (Blueprint $table) {
            $table->id();
            $table->string("min_balance");
            $table->string("max_balance");
            $table->string("inc_limit");
            $table->string("min_return");
            $table->string("max_return");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_details');
    }
};

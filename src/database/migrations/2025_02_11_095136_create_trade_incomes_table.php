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
        Schema::create('trade_incomes', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->decimal("prev_inc", 30,2);
            $table->decimal("new_inc", 30,2);
            $table->decimal("wallet", 30,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_incomes');
    }
};

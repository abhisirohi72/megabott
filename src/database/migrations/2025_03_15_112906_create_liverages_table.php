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
        Schema::create('liverages', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->float("amount", 8,2);
            $table->integer("time_duration");
            $table->enum("status", [0,1])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liverages');
    }
};

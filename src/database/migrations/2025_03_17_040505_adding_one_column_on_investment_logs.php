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
        Schema::table('investment_logs', function (Blueprint $table) {
            $table->date('profit_time')->nullable(); // Add the DATE column here
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investment_logs', function (Blueprint $table) {
            $table->dropColumn('profit_time'); // If you need to rollback the migration
        });
    }
};

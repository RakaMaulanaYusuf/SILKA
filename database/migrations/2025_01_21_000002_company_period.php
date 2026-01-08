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
        Schema::create('company_period', function (Blueprint $table) {
            $table->char('period_id', 12)->primary();
            $table->enum('period_month', ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni','Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
            $table->year('period_year');

            $table->char('company_id', 8);
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->unique(['company_id', 'period_month', 'period_year']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_period');
    }
};

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
        Schema::create('aktiva_lancar', function (Blueprint $table) {
            $table->char('aktivalancar_id', 17);
            $table->string('kode_akun', 20);
            $table->string('nama_akun', 50);
            $table->decimal('jumlah', 15, 2)->default(0);
            
            $table->char('company_id', 8);
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->char('period_id', 12);
            $table->foreign('period_id')->references('period_id')->on('company_period')->onDelete('cascade');
            $table->foreign('kode_akun')->references('kode_akun')->on('kode_akun');
            
            $table->unique(['company_id', 'period_id', 'kode_akun']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktiva_lancar');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hpp', function (Blueprint $table) {
            $table->id('hpp_id');
            $table->string('company_id', 100);
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->string('period_id', 100);
            $table->foreign('period_id')->references('period_id')->on('company_period')->onDelete('cascade');
            $table->string('kode_akun', 50);
            $table->string('nama', 50);
            $table->decimal('jumlah', 15, 2)->default(0);
            $table->timestamps();
            
            $table->foreign('kode_akun')->references('kode_akun')->on('kode_akun');
            $table->unique(['company_id', 'period_id', 'kode_akun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hpp');
    }
};
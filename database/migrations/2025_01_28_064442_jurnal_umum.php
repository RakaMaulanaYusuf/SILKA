<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnal_umum', function (Blueprint $table) {
            $table->id('jurnalumum_id');
            $table->string('company_id', 100);
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->string('period_id', 100);
            $table->foreign('period_id')->references('period_id')->on('company_period')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('bukti_transaksi', 50);
            $table->string('keterangan', 50);
            $table->string('kode_akun', 50);
            $table->string('kode_bantu', 50)->nullable();
            $table->decimal('debit', 15, 2)->nullable();  
            $table->decimal('credit', 15, 2)->nullable(); 
            $table->timestamps();
            
            $table->foreign('kode_akun')->references('kode_akun')->on('kode_akun')->onDelete('cascade');
            $table->foreign('kode_bantu')->references('kode_bantu')->on('kode_bantu')->onDelete('set null');
            $table->index(['tanggal', 'bukti_transaksi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnal_umum');
    }
};
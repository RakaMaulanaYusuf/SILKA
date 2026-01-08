<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnal_umum', function (Blueprint $table) {
            $table->char('jurnalumum_id', 17);
            $table->date('tanggal');
            $table->string('bukti_transaksi', 50);
            $table->string('keterangan', 50);
            $table->string('kode_akun', 20);
            $table->string('kode_bantu', 20)->nullable();
            $table->decimal('debit', 18, 2)->nullable();  
            $table->decimal('credit', 18, 2)->nullable(); 
            
            $table->char('company_id', 8);
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->char('period_id', 12);
            $table->foreign('period_id')->references('period_id')->on('company_period')->onDelete('cascade');
            $table->foreign('kode_akun')->references('kode_akun')->on('kode_akun');
            $table->foreign('kode_bantu')->references('kode_bantu')->on('kode_bantu');
            
            $table->index(['tanggal', 'bukti_transaksi']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnal_umum');
    }
};
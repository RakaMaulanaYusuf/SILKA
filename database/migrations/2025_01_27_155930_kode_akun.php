<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kode_akun', function (Blueprint $table) {
            $table->id('kodeakun_id');
            $table->string('company_id', 100);
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->string('period_id', 100);
            $table->foreign('period_id')->references('period_id')->on('company_period')->onDelete('cascade');
            $table->string('kode_akun', 50);
            $table->string('nama_akun', 50);
            $table->string('tabel_bantuan', 50)->nullable();
            $table->enum('pos_saldo', ['DEBIT', 'CREDIT'])->default('DEBIT');
            $table->enum('pos_laporan', ['NERACA', 'LABARUGI'])->default('NERACA');
            $table->decimal('debit', 15, 2)->default(0)->nullable()->comment('Saldo Awal Debet');
            $table->decimal('credit', 15, 2)->default(0)->nullable()->comment('Saldo Awal Kredit');
            $table->timestamps();
            $table->index('kode_akun');
            $table->index('nama_akun');
            $table->unique(['company_id', 'period_id', 'kode_akun'], 'unique_account_per_company_period');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kode_akun');
    }
};
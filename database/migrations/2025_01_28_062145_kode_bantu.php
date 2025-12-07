<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kode_bantu', function (Blueprint $table) {
            $table->char('kodebantu_id', 6)->primary();
            $table->string('kode_bantu', 10);
            $table->string('nama_bantu', 50);
            $table->enum('status', ['PIUTANG', 'HUTANG'])->default('PIUTANG');
            $table->decimal('balance', 15, 2)->default(0);

            $table->char('company_id', 6);
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->char('period_id', 6);
            $table->foreign('period_id')->references('period_id')->on('company_period')->onDelete('cascade');
            
            $table->index('kode_bantu');
            $table->index('nama_bantu');
            $table->unique(['company_id', 'period_id', 'kode_bantu'], 'unique_helper_per_company_period');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kode_bantu');
    }
};
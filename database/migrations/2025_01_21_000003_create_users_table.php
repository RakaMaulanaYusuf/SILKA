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
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id', 100)->primary();
            $table->string('nama', 50);
            $table->string('email', 50)->unique();
            $table->string('password', 100);
            $table->enum('role', ['admin', 'staff'])->default('staff');
            $table->string('profile_photo')->nullable();
            // $table->foreignId('active_company_id')->nullable()->constrained('company', 'company_id')->onDelete('set null');
            // $table->foreignId('assigned_company_id')->nullable()->constrained('companies')->onDelete('set null');
            $table->string('company_id', 100)->nullable();
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('set null');
            $table->string('period_id', 100)->nullable();
            $table->foreign('period_id')->references('period_id')->on('company_period')->onDelete('set null');
            // $table->foreignId('company_period_id')->nullable()->constrained('company_period', 'period_id')->onDelete('set null');
            // $table->foreignId('assigned_company_period_id')->nullable()->constrained('company_period')->onDelete('set null');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
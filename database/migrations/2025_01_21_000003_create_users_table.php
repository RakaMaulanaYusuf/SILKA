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
            $table->char('user_id', 6)->primary();
            $table->string('nama', 50);
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'staff'])->default('staff');
            $table->string('profile_photo')->nullable();

            $table->char('company_id', 6)->nullable();
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('set null');
            $table->char('period_id', 6)->nullable();
            $table->foreign('period_id')->references('period_id')->on('company_period')->onDelete('set null');

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
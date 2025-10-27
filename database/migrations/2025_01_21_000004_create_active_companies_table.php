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
        Schema::create('active_companies', function (Blueprint $table) {
            $table->id('aktifcompanyid');
            $table->string('user_id', 100);
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            // $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('company_id', 100);
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('cascade');
            // $table->foreignId('company_id')->constrained('company', 'company_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_companies');
    }
};

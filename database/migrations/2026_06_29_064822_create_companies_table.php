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
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->index();
            $table->string('slug')->unique();
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->string('head_office')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('founded_year')->nullable();
            $table->string('employees_count')->nullable();
            $table->integer('trust_score')->default(0);
            $table->string('risk_level')->default('UNKNOWN'); // LOW RISK, MEDIUM RISK, HIGH RISK
            $table->text('ai_summary')->nullable();
            $table->string('status')->default('processing'); // processing, completed, failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

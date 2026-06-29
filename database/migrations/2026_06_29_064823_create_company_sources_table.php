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
        Schema::create('company_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('source_name'); // e.g., Official Website, Google Review, Reddit, News
            $table->string('source_url')->nullable();
            $table->string('status')->default('Verified'); // Verified, Neutral, Warning
            $table->integer('confidence_score')->default(90); // e.g. 95%
            $table->string('last_updated')->nullable(); // e.g. "Hari ini"
            $table->text('summary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_sources');
    }
};

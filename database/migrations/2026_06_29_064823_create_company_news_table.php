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
        Schema::create('company_news', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('title');
            $table->string('url')->nullable();
            $table->string('source')->nullable(); // e.g., Kompas, Detik, Bisnis.com
            $table->string('published_date')->nullable(); // e.g., "2 hari yang lalu"
            $table->text('summary')->nullable();
            $table->string('sentiment')->default('Neutral'); // Positive, Neutral, Negative
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_news');
    }
};

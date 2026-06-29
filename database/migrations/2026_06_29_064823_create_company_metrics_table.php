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
        Schema::create('company_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('company_id')->constrained('companies')->onDelete('cascade');
            $table->integer('review_score')->default(0);
            $table->integer('news_score')->default(0);
            $table->integer('website_score')->default(0);
            $table->integer('digital_presence_score')->default(0);
            $table->json('positive_topics')->nullable();
            $table->json('negative_topics')->nullable();
            $table->json('website_health')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_metrics');
    }
};

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
        Schema::create('data_corrections', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('reporter_name')->nullable();
            $table->string('reporter_email')->nullable();
            $table->text('correction_details');
            $table->string('status')->default('pending'); // pending, reviewed, resolved
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_corrections');
    }
};

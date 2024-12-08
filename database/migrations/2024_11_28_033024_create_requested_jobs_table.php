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
        Schema::create('requested_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('chambero_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('quote_id')->constrained('quotations')->onDelete('cascade');
            $table->enum('status', ['in progress', 'completed', 'canceled'])->default('in progress');
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_reviewed')->default(false); // Indicates if a review was left
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requested_jobs');
    }
};

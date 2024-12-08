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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id('quotation_id');
            $table->foreignId('client_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('chambero_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->text('service_description');
            $table->dateTime('scheduled_date');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['pending', 'offer', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};

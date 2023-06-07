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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_id');
            $table->decimal('amount', 12, 2);
            $table->decimal('deposit', 12, 2)->default(0);
            $table->unsignedTinyInteger('status')->default(0);
            $table->dateTime('deadline');
            $table->timestamps();

            $table->foreign('credit_id')->references('id')->on('credits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};

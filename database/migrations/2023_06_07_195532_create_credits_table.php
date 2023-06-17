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
        Schema::create('credits', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('customer_serial', 30);
            $table->decimal('amount', 12);
            $table->decimal('deposit', 12)->default(0);
            $table->unsignedInteger('term');
            $table->unsignedTinyInteger('status')->default(0);
            $table->string('serial', 30)->unique();
            $table->dateTime('deadline');
            $table->timestamps();

            $table->foreign('customer_serial')->references('serial')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};

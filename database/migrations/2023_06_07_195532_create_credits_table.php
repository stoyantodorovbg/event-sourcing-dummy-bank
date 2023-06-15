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
            $table->uuid()->primary();;
            $table->uuid('borrower_uuid');
            $table->decimal('amount', 12, 2);
            $table->decimal('deposit', 12, 2)->default(0);
            $table->unsignedInteger('term');
            $table->unsignedTinyInteger('status')->default(0);
            $table->string('code');
            $table->dateTime('deadline');

            $table->timestamps();

            $table->foreign('borrower_uuid')->references('uuid')->on('borrowers')->onDelete('cascade');
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

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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->unsignedBigInteger('period_id');
            $table->unsignedBigInteger('wordlist_id');
            $table->unsignedBigInteger('student_id');
            $table->integer('result');
            $table->string('mistakes')->default('');

            $table->timestamps();

            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('wordlist_id')->references('id')->on('lists');
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};

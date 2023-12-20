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
        Schema::create('list_test', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('list_id');
            $table->unsignedBigInteger('test_id');

            $table->foreign('list_id')->references('id')->on('lists');
            $table->foreign('test_id')->references('id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_test');
    }
};

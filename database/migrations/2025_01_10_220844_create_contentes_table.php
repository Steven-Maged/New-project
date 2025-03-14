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
        Schema::create('contentes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->unsignedBigInteger('course_id');// Correctly declared unsignedBigInteger
            $table->timestamps();
            // Correctly reference 'id' in the 'cources' table
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};

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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('courseName');
            $table->text('courseDescription')->nullable();
            $table->unsignedBigInteger('track_id'); 
            $table->string('coursePhoto');
            $table->double('Price');
            $table->boolean('bayState');
            $table->timestamps();
            // Correctly reference 'id' in the 'pathes' table
            $table->foreign('track_id')->references('id')->on('traks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

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
        Schema::create('traks', function (Blueprint $table) {
            $table->id(); 
            $table->string('trackName');
            $table->string('trackPhoto');
            $table->text('trackDescription');
            $table->string('trackCategory');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traks');
    }
};

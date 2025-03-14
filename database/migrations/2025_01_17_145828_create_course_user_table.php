<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_user', function (Blueprint $table) {
            $table->id(); // معرف فريد لكل صف في الجدول
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // العلاقة مع جدول المستخدمين
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // العلاقة مع جدول الكورسات
            $table->timestamp('purchase_date')->nullable(); // تاريخ الشراء
            $table->enum('payment_status', ['pending', 'paid'])->default('pending'); // حالة الدفع
            $table->timestamps(); // إضافة أعمدة created_at و updated_at
            $table->unique(['user_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_user');
    }
}

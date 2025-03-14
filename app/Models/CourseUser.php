<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseUser extends Pivot
{
    /**
     * الخصائص التي يمكن تعبئتها.
     */
    protected $fillable = [
        'user_id', 
        'course_id', 
        'purchase_date', // على سبيل المثال، إضافة تاريخ الشراء
        'payment_status' // حالة الدفع
    ];

    /**
     * العلاقة مع المستخدم.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * العلاقة مع الكورس.
     */
    public function course()
    {
        return $this->belongsTo(Courses::class);
    }
}

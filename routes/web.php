<?php

use App\Http\Controllers\TraksController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ContentesController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



use App\Http\Controllers\StripeController;

Route::post('/credit/{courseId}', [StripeController::class, 'credit'])->name('checkout');
Route::get('/callback', [StripeController::class, 'callback'])->name('callback');


Route::get('/pay',  function ()  {
    return view('checkout');
});



// Route for the home page
Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Support\Facades\DB;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $user = auth()->user();
    $ipAddress = request()->ip(); // الحصول على IP المستخدم
    $userId = auth()->id(); // الحصول على معرف المستخدم إذا كان مسجلاً

    // تحقق مما إذا كان هناك سجل موجود بالفعل لهذا المستخدم في نفس اليوم
    $existingVisit = DB::table('user_visits')
        ->where('user_id', $userId)
        ->whereDate('visited_at', now()->toDateString())
        ->first();

    if (!$existingVisit) {
        // أدخل زيارة جديدة لكل مستخدم يزور الصفحة
        DB::table('user_visits')->insert([
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'visited_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // إعداد بيانات الرسم البياني
    $visits = DB::table('user_visits')
        ->select(DB::raw('DATE(visited_at) as date'), DB::raw('count(*) as count'))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

    $visitChartData = [
        'labels' => $visits->pluck('date')->toArray(),
        'data' => $visits->pluck('count')->toArray(),
    ];

    


    // إعداد بيانات الرسم البياني للكورسات حسب تاريخ الإنشاء
    $courses = DB::table('courses')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

    $courseChartData = [
        'labels' => $courses->pluck('date')->toArray(),
        'data' => $courses->pluck('count')->toArray(),
    ];


    if ($user->role == 'admin') {
        return view('dashboard', compact('visitChartData', 'courseChartData'));
    }
    $count_course = DB::table('courses')->count();
    $count_users= DB::table('users')->count();
    return view('home' , compact('count_course','count_users'));
})->name('dashboard');



// // Test route for admin dashboard
// Route::middleware(['auth:sanctum', 'verified'])->get('/admin-dashboard', function () {
//     $user = auth()->user();
//     if ($user->role != 'admin') {
//         return 'Welcome, Admin!';
//     } else {
//         abort(403, 'You are not authorized to view this page.');
//     }
// });

// Route to check the authenticated user and their role
Route::get('/check-user', function () {
    $user = auth()->user();
    if ($user) {
        return response()->json([
            'user' => $user,
            'role' => $user->role, 
        ]);
    } else {
        return response()->json(['message' => 'No user authenticated'], 401);
    }
});

// Admin routes for Tracks, Courses, and Contents
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Admin routes for Tracks
    Route::get('traks/create', function () {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(TraksController::class)->create();
    })->name('traks.create');

    Route::post('traks', function () {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(TraksController::class)->store(request());
    })->name('traks.store');

    Route::get('traks/{trak}/edit', function (App\Models\Traks $trak) {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(TraksController::class)->edit($trak);
    })->name('traks.edit');

    Route::put('traks/{trak}', function (Request $request, App\Models\Traks $trak) {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(TraksController::class)->update($request, $trak);
    })->name('traks.update');

    Route::delete('traks/{trak}', function (App\Models\Traks $trak) {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(TraksController::class)->destroy($trak);
    })->name('traks.destroy');

    // Admin routes for Courses
    Route::get('courses/create', function () {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(CoursesController::class)->create();
    })->name('courses.create');

    Route::post('courses', function () {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(CoursesController::class)->store(request());
    })->name('courses.store');

    Route::get('courses/{course}/edit', function (App\Models\Courses $course) {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(CoursesController::class)->edit($course);
    })->name('courses.edit');

    Route::put('courses/{course}', function (Request $request, App\Models\Courses $course) {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(CoursesController::class)->update($request, $course);
    })->name('courses.update');

    Route::delete('courses/{course}', function (App\Models\Courses $course) {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(CoursesController::class)->destroy($course);
    })->name('courses.destroy');

    // Admin routes for Contents
    Route::get('contents/create', function () {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(ContentesController::class)->create();
    })->name('contents.create');

    Route::post('contents', function () {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(ContentesController::class)->store(request());
    })->name('contents.store');

    Route::get('contents/{content}/edit', function (App\Models\Contentes $content) {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(ContentesController::class)->edit($content);
    })->name('contents.edit');

    Route::put('contents/{content}', function (Request $request, App\Models\Contentes $content) {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(ContentesController::class)->update($request, $content);
    })->name('contents.update');

    Route::delete('contents/{content}', function (App\Models\Contentes $content) {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(ContentesController::class)->destroy($content);
    })->name('contents.destroy');
});
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
// Public routes for viewing Tracks, Courses, and Contents
Route::prefix('traks')->group(function () {
    Route::get('/', [TraksController::class, 'index'])->name('traks.index');
    Route::get('/{trak}', [TraksController::class, 'show'])->name('traks.show');
});

Route::prefix('courses')->group(function () {
    Route::get('/', [CoursesController::class, 'index'])->name('courses.index');
    Route::get('/{course}', [CoursesController::class, 'show'])->name('courses.show');
    Route::get('/{trakId}/courses', [CoursesController::class, 'getCoursesByTrak'])->name('courses.by.trak');
});

Route::prefix('contents')->group(function () {
    Route::get('/', [ContentesController::class, 'index'])->name('contents.index');
    Route::get('/{content}', [ContentesController::class, 'show'])->name('contents.show');
    Route::get('/course/{courseId}/content', [ContentesController::class, 'getContentsByCourse'])->name('content.by.course');
});

});


// Admin control users routes

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Admin route to view all users
    Route::get('admin/users', function () {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(UserController::class)->index();
    })->name('admin.users.index');

    // Admin route to show create user form
    Route::get('admin/users/create', function () {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(UserController::class)->create(); 
    })->name('admin.users.create');

    // Admin route to store a new user
    Route::post('admin/users', function (Request $request) {
        $user = auth()->user();
        if ($user->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(UserController::class)->store($request); // إضافة مستخدم جديد
    })->name('admin.users.store');

    // Admin route to edit a user
    Route::get('admin/users/{user}/edit', function (App\Models\User $user) {
        $authUser = auth()->user();
        if ($authUser->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(UserController::class)->edit($user); // عرض نموذج تعديل بيانات المستخدم
    })->name('admin.users.edit');

    // Admin route to update a user's data
    Route::put('admin/users/{user}', function (Request $request, App\Models\User $user) {
        $authUser = auth()->user();
        if ($authUser->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(UserController::class)->update($request, $user); // تعديل بيانات المستخدم
    })->name('admin.users.update');

    // Admin route to delete a user
    Route::delete('admin/users/{user}', function (App\Models\User $user) {
        $authUser = auth()->user();
        if ($authUser->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return app(UserController::class)->destroy($user); // حذف المستخدم
    })->name('admin.users.destroy');
});





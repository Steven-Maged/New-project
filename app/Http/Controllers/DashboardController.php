<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view with chart data.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // استعلام للحصول على عدد المستخدمين حسب الدور
        $roles = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role');

        // تحضير البيانات للمخطط
        $chartData = [
            'labels' => $roles->keys()->toArray(),
            'data' => $roles->values()->toArray(),
        ];

        // عرض صفحة Dashboard مع تمرير بيانات المخطط
        return view('dashboard', compact('chartData'));
    }
}

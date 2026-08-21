<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Message;
use App\Models\Visitor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $unreadMessages = Message::where('is_read', false)->count();
        
        $todayVisitors = Visitor::whereDate('visited_date', Carbon::today())->count();
        $monthlyVisitors = Visitor::whereMonth('visited_date', Carbon::now()->month)
                                  ->whereYear('visited_date', Carbon::now()->year)
                                  ->count();

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'unreadMessages', 'todayVisitors', 'monthlyVisitors'));
    }
}

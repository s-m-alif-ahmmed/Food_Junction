<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard page.
     *
     * @return View
     */


    public function index(): View
    {
        $users_count = User::where('role', 'User, Super Admin' )->count();
        return view('backend.layouts.dashboard.index',compact('users_count'));

    }

    public function adminDashboard(): View
    {
        $users_count = User::where('role', 'User')->count();
        $total_orders = Order::count();
        $total_revenue = Order::where('status', 'complete')->sum('final_total');
        $pending_orders = Order::where('status', 'pending')->count();
        $completed_orders = Order::where('status', 'complete')->count();
        $recent_orders = Order::latest()->take(5)->get();

        // Monthly sales for ApexCharts
        $monthly_sales = Order::where('status', 'complete')
            ->whereYear('created_at', date('Y'))
            ->selectRaw('MONTH(created_at) as month, SUM(final_total) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $sales_data = [];
        for ($m = 1; $m <= 12; $m++) {
            $sales_data[] = isset($monthly_sales[$m]) ? (float)$monthly_sales[$m] : 0;
        }

        $canceled_orders = Order::where('status', 'canceled')->count();
        $returned_orders = Order::where('status', 'return')->count();

        return view('backend.layouts.dashboard.index', compact(
            'users_count',
            'total_orders',
            'total_revenue',
            'pending_orders',
            'completed_orders',
            'canceled_orders',
            'returned_orders',
            'recent_orders',
            'sales_data'
        ));
    }

    public function userDashboard(): View
    {
        $orders = Order::where('user_id', Auth::user()->id)->get(); // Fetch all orders for the user
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->latest()->get();

        return view('frontend.dashboard.dashboard', compact('orders','wishlists'));
    }

}

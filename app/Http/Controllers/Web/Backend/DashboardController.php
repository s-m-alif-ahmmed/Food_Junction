<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
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

        return view('backend.layouts.dashboard.index',compact('users_count'));

    }

    public function userDashboard(): View
    {
        $orders = Order::where('user_id', Auth::user()->id)->get(); // Fetch all orders for the user

        return view('frontend.dashboard.dashboard', compact('orders'));
    }

}

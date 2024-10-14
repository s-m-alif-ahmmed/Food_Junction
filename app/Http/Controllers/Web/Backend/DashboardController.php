<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
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

        // Get the current date and time
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i:s');


        return view('backend.layouts.dashboard.index', [
            'verifiedUsers'  => User::where('status','active')->count(),
            'nonVerifiedUsers'  => User::where('status','inactive')->count(),
        ]);
    }
}

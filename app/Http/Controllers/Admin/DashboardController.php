<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Banner;
use App\Models\DriverAvailability;
use App\Models\Drivers;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalDrivers = Drivers::count();
        $totalBanners = Banner::count();
        $totalAvailableDrivers = DriverAvailability::where('status', true)->count();

        return view('admin.dashboard', compact('totalUsers', 'totalDrivers', 'totalBanners', 'totalAvailableDrivers'));
    }

}

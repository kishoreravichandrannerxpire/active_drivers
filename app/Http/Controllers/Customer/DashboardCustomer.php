<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardCustomer extends Controller
{
    public function index()
    {
        return view('customer.dashboard' );
    }

   public function dashboard()
   {
    return view('customer.dashboard');
   }




}

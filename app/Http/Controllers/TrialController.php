<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class TrialController extends Controller
{
    public function index()
    {
        return view('trial');
    }
    public function second()
    {
        return view('trial2');
    }

    public function login()
    {
        return view('login_form');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'superadmin')
        {
            return view ('superadmin.dashboard');
        }

        if(Auth::user()->role == 'owner')
        {
            return view ('owner.dashboard');
        }

        if(Auth::user()->role == 'resepsionis')
        {
            return view ('resepsionis.dashboard');
        }

        if(Auth::user()->role == 'staff')
        {
            return view ('staff.dashboard');
        }
    }
}

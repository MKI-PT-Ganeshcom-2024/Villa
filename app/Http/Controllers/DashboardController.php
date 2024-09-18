<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'Superadmin')
        {
            return view ('web.role.superadmin.dashboard');
        }

        if(Auth::user()->role == 'Owner')
        {
            return view ('web.role.owner.dashboard');
        }

        if(Auth::user()->role == 'Resepsionis')
        {
            return view ('web.role.resepsionis.dashboard');
        }

        if(Auth::user()->role == 'Staff')
        {
            return view ('web.role.staff.dashboard');
        }
    }
}

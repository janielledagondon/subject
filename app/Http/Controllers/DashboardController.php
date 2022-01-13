<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if (Auth::user()->hasRole('guest')) {
            return view('guestdash');
        }elseif (Auth::user()->hasRole('incharge')) {
            return view('inchargedash');
        }elseif (Auth::user()->hasRole('admin')) {
            return view('dashboard');
        }
    }

    public function showsubjects(){
        return view('showsubjects');
    }

    public function manage(){
        return view('manage');
    }
}

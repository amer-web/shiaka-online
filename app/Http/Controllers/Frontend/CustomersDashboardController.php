<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomersDashboardController extends Controller
{
    public function index()
    {
        return view('frontend.customers.index');
    }

    public function address()
    {
        return view('frontend.customers.address');
    }

    public function profile()
    {
        return view('frontend.customers.profile');
    }
}

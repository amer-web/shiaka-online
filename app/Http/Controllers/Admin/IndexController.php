<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Torann\Currency\Facades\Currency;

class IndexController extends Controller
{
    public function index()
    {

        return view('admin.index');
    }
    public function lang($code)
    {
        session()->put('currency',$code);
        return redirect($_SERVER['HTTP_REFERER']);
    }
}

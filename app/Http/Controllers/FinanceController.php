<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Customer;
use DataTables;
use Auth;
use App\Models\Category;

class FinanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        $data['user'] = Auth::user();
        return view('finance/index', $data);
    }

    public function fiInputSpend(){
        $data['categories'] = Category::all();
        return view('finance/inputSpend', $data);
    }
}

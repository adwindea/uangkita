<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
// use App\Models\Customer;
use DataTables;
use Auth;
use App\Models\Category;
use App\Models\Spending;
use App\Models\User;

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

    public function fiInputSpendExe(Request $request){
        $request->validate([
            'description' => 'required',
            'category' => 'required',
            'amount' => 'required|numeric'
        ]);
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        try{
            $input['category'] = Crypt::decrypt($input['category']);
        }catch(\RuntimeException $e){
            $cat = array(
                'category_name'=>strtoupper($input['category']),
                'user_id'=>Auth::user()->id
            );
            $insert = Category::create($cat);
            $input['category'] = $insert->id;
        }
        $spending = Spending::create($input);
        return redirect()->route('inputSpend')->with('success','Data saved successfully.');
    }

    public function fiSpendData(){
        return view('finance/spendData');
    }
    public function fiGetSpendData(){
        $spending = \App\Models\Spending::with(['user:id,name', 'cat:id,category_name'])->get();
        // $spending = \App\Models\Spending::with([
        //     'user' => function($query){
        //         $query->select('name as user_name');
        //     },
        //     'cat' => function($query){
        //         $query->select('category_name as category_name');
        //     }
        //     ])->get()->toArray();
        dd($spending->cat);
    }
}

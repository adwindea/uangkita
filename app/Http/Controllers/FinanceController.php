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
        $data['categories'] = Category::all();
        return view('finance/spendData', $data);
    }
    public function fiGetSpendData(Request $request){
        $spending = \App\Models\Spending::with(['user:id,name as user_name', 'cat:id,category_name'])->where('user_id', Auth::user()->id);
        if($catx = $request->get('cat')){
            $cat = array();
            foreach($catx as $c){
                array_push($cat, Crypt::Decrypt($c));
            }
            $spending->whereIn('category', $cat);
        }
        if($from = $request->get('from')){
            $spending->whereDate('created_at', '>=', $from);
        }
        if($to = $request->get('to')){
            $spending->whereDate('created_at', '<=', $to);
        }
        $spending->get();
        return Datatables::of($spending)
            ->removeColumn('id')
            ->removeColumn('category')
            ->addColumn('category_name', '{{$cat["category_name"]}}')
            ->editColumn('amount', '{{number_format($amount,0)}}{{" IDR"}}')
            ->editColumn('created_at', '{{date(("d M Y"), strtotime($created_at))}}')
            ->addIndexColumn()
            // ->filter(function ($instance) use ($request){
            //     if(!empty($request->get))
            // })
            // ->addColumn('action', function ($customers) {
            //     return '<a href="#edit-'.$customers->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            // })
            // ->editColumn('id', '{{$id}}')
            // ->removeColumn('password')
            // ->setRowId('id')
            // ->setRowClass(function ($customers) {
            //     return $customers->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            // })
            // ->setRowData([
            //     'id' => 'test',
            // ])
            // ->setRowAttr([
            //     'color' => 'red',
            // ])
            ->make(true);
    }
}

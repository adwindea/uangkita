<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
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
        return view('customer/index');
    }
    public function custData(){
        return view('customer/custData');
    }
    public function getCustData()
    {
        $customer = Customer::select(['id', 'id_pel', 'name', 'class', 'power', 'option']);
        // return Datatables::of($users)
        //     ->addColumn('action', function ($user) {
        //         return '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        //     })
        //     ->editColumn('id', '{{$id}}')
        //     ->removeColumn('password')
        //     ->setRowId('id')
        //     ->setRowClass(function ($user) {
        //         return $user->id % 2 == 0 ? 'alert-success' : 'alert-warning';
        //     })
        //     ->setRowData([
        //         'id' => 'test',
        //     ])
        //     ->setRowAttr([
        //         'color' => 'red',
        //     ])
        //     ->make(true);
    }
}

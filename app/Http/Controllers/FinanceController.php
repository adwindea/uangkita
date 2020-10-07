<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
// use App\Models\Customer;
use DataTables;
use Auth;
use App\Models\Category;
use App\Models\Spending;
use App\Models\Income;
use App\Models\User;
use App\Models\MainSetting;
use App\Models\Budget;

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

    public function fiMainSetting(Request $request){
        $searchText = $request->get('searchText');
        $data['mainsetting'] = MainSetting::where('user_id', Auth::user()->id)->where('tag', 'like', '%'.$searchText.'%')->get();
        $data['searchText'] = $searchText;
        return view('finance/mainSetting', $data);
    }
    public function fiEditMainSetting(Request $request){
        $request->validate([
            'period_date' => 'required|numeric'
        ]);
        $period_date = $request->get('period_date');
        $id = $request->get('setting_id');
        try{
            $id = Crypt::decrypt($id);
        }catch(\RuntimeException $e){
            $id = '';
        }
        $update = array('value'=> $period_date);
        $setting = MainSetting::where('id', $id)->update($update);
        return redirect()->route('mainSetting')->with('success','Data saved successfully.');
    }

    public function index(Request $request){
        $month = $request->get('month');
        if(empty($month)){
            $month = date('Y-m');
        }
        $data['month'] = $month;
        $data['user'] = Auth::user();
        return view('finance/index', $data);
    }

    public function fiLoadDashboard($month){
        if(empty($month)){
            $month = date('Y-m');
        }
        $cutoff = MainSetting::where('user_id', Auth::user()->id)->where('tag', 'cut_off')->first();
        if($cutoff->value >= 10){
            $from = $month.'-'.$cutoff->value;
        }else if($cutoff->value < 10){
            $from = $month.'-0'.$cutoff->value;
        }
        if($cutoff->value > 20){
            $from = date('Y-m-d', strtotime($from.'-1 month'));
        }
        $to = date('Y-m-d', strtotime($from.'+1 month'));

        //SUMMARY
        $total_spend = Spending::selectRaw('sum(amount) as amount')
        ->where('spend_date', '>=', $from)
        ->where('spend_date', '<', $to)
        ->where('user_id', Auth::user()->id)
        ->first();
        $total_income = Income::selectRaw('sum(amount) as amount')
        ->where('income_date', '>=', $from)
        ->where('income_date', '<', $to)
        ->where('user_id', Auth::user()->id)
        ->first();
        $saving = $total_income->amount-$total_spend->amount;
        $saving_percent = 0;
        if(!empty($total_income->amount)){
            $saving_percent = ($total_income->amount-$total_spend->amount)/$total_income->amount*100;
        }

        //PIE CHART
        $pie = '';
        $monthly_spend = Spending::selectRaw('sum(amount) as amount, category')
        ->with(['user:id,name as user_name', 'cat:id,category_name'])
        ->where('spend_date', '>=', $from)
        ->where('spend_date', '<', $to)
        ->where('user_id', Auth::user()->id)
        ->groupBy('category')
        ->get();
        if(!empty($monthly_spend)){
            foreach($monthly_spend as $m){
                $percent = 0;
                if(!empty($total_spend->amount) and $total_spend->amount != 0){
                    $percent = $m->amount/$total_spend->amount*100;
                }
                $pie .= '{
                    name: "'.$m->cat->category_name.'",
                    y: '.$percent.'},';
            }
        }
        $pie = substr($pie, 0, -1);

        // DAILY SPENDING
        $dd = '';
        $chart = '';
        for($tanggal=$from;$tanggal<=$to;$tanggal=date('Y-m-d', strtotime($tanggal. '+1 day'))){
            $total = 0;
            $spend = Spending::selectRaw('*, sum(amount) as amount')
            ->with(['user:id,name as user_name', 'cat:id,category_name'])
            ->where('user_id', Auth::user()->id)
            ->where('spend_date', $tanggal)
            ->groupBy('category')
            ->get();
            if(!empty($spend)){
                $x = 0;
                $ddd =
                '{
                    name: "'.$tanggal.'",
                    id: "'.$tanggal.'",
                    data: [';
                foreach($spend as $s){
                    if(!empty($s->amount)){
                        $ddd .= '["'.$s->cat->category_name.'",'.$s->amount.'],';
                        $total = $total + $s->amount;
                        $x++;
                    }
                }
                $ddd = substr($ddd,0,-1);
                $ddd .= ']},';
                if($x > 0){
                    $dd .= $ddd;
                }
            }
            $chart .= '{
				name: "'.$tanggal.'",
				y: '.$total.',
				drilldown: "'.$tanggal.'"},';
        }
        $data['total_spend'] = $total_spend->amount+0;
        $data['total_income'] = $total_income->amount+0;
        $data['saving'] = $saving;
        $data['saving_percent'] = $saving_percent;
        $data['chart'] = substr($chart,0,-1);
        $data['dd'] = $dd;
        $data['pie'] = $pie;
        $data['monthly_spend'] = $monthly_spend;
        return view('finance/dashboard', $data);
    }

    public function fiInputSpend(){
        $data['categories'] = Category::where('user_id', Auth::user()->id)
        ->get();
        return view('finance/inputSpend', $data);
    }

    public function fiInputSpendExe(Request $request){
        $request->validate([
            'description' => 'required',
            'category' => 'required',
            'amount' => 'required|numeric',
            'spend_date' => 'required'
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
    public function fiInputIncomeExe(Request $request){
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'income_date' => 'required'
        ]);
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $income = Income::create($input);
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
            // ->removeColumn('category')
            ->editColumn('category', '{{$cat["category_name"]}}')
            ->editColumn('amount', '{{number_format($amount,0)}}{{" IDR"}}')
            ->editColumn('spend_date', '{{date(("d M Y"), strtotime($spend_date))}}')
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

    function fiBudget(){
        $data['categories'] = Category::where('user_id', Auth::user()->id)->get();
        $data['budgets'] = Budget::with('category:id,category_name')->where('user_id', Auth::user()->id)->orderBy('period_date', 'desc')->paginate(3);
        return view('finance/budget', $data);
    }

}

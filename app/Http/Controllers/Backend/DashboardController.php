<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;


class DashboardController extends Controller
{
    public function index(Request $request){
        
      	if(!auth()->user()->can('dashboard.access'))
        {
            abort(403, 'unauthorized');
        }
        
        $status=$request->status;
        $q=$request->q;
		$query=Order::whereHas('details.product', function($q){
        $q->whereNotNull('name');
        	});
                if(!empty($q)){
                    $query->where(function($row) use ($q){
                        $row->where('invoice_no','Like','%'.$q.'%');
                    });
                }
                
                if(!empty($status)){
         
                    $query->where('status','Like','%'.$status.'%');
                    
                }
                
                if(Auth::user()->hasRole('worker'))
                {
                    $query->where('assign_user_id', Auth::id());
                }        
        
        $items=$query->latest()->take(20)->get();       
        $statuses=getOrderStatus();


        
        
        $start = Carbon::parse(Order::where('status', 'pending')->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ])->min('created_at'));

        $end = Carbon::now();
        $period = CarbonPeriod::create($start, "1 month", $end);

        
        // $ordersPerMonth = collect($period)->map(function ($date) {
        //     $endDate = $date->copy()->endOfMonth();
        //     return [
        //         "count" => Order::where('status', 'pending')->where("created_at", "<=", $endDate)->count(),
        //         "month" => $endDate->format("Y-m-d")
        //     ];
        // });
        // dd($ordersPerMonth);

        // $data = $ordersPerMonth->pluck("count")->toArray();
        // $labels = $ordersPerMonth->pluck("month")->toArray();

        $thisMonthOrder = Order::whereBetween('created_at',[ 
        Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()])->get()->groupBy('date');
        $cOrder = [];
        foreach ($thisMonthOrder as $key => $order) {
            $cOrder['label'][] = $key;
            $cOrder['delivered'][] = $order->where('status', 'delivered')->count(); 
            $cOrder['returned'][] = $order->where('status', 'pending')->count(); 
        }

        $chart = app()
        ->chartjs
        ->name('MonthlySalesChart')
        ->type('bar')
        ->size(['width' =>400, 'height'=>200])
        ->labels($cOrder['label'])
        ->datasets([
            [
                "label" => "Delivered",
                "backgroundColor" => "rgba(38, 185, 154, 0.31)",
                "borderColor" => "rgba(38, 185, 154, 0.7)",
                "data" => $cOrder['delivered']
            ],
            [
                "label" => "Returned",
                "backgroundColor" => "rgba(244, 72, 25, 0.38)",
                "borderColor" => "rgba(244, 72, 25, 0.69)",
                "data" => $cOrder['returned']
            ]
        ])
        ->options([
            'scales' => [
                'x' => [
                    'type' => 'time',
                    'time' => [
                        'unit' => 'month'
                    ],
                    'min' => $start->format("Y-m-d"),
                ]
            ],
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Monthly User Registrations'
                ]
            ]
        ]);

        return view('backend.dashboard', compact('items','chart','status','q','statuses'));
    }
  
  	public function getDashboardData(){
        $order= Order::all();
    	$data['products']=Product::count();
      	$data['orders']=Order::count();
      	$data['users']=User::count();
        $data['current_month_sell']=Order::whereMonth('created_at', date('m'))->sum('final_amount');
      	$data['today_sell']=Order::whereDate('created_at', date('Y-m-d'))->sum('final_amount');
        $data['prev_month_sell']=Order::whereBetween('created_at', 
                                    [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]
                                )->sum('final_amount');
        $data['orderProcessing']=Order::where('status','processing')->count();
        $data['orderPending']=Order::where('status','pending')->count();
        $data['orderCancel'] = $order->where('status', 'cancell')->count();
        $data['orderDelivered'] = $order->where('status', 'complete')->count();
        $data['orderReturn'] = $order->where('status', 'return')->count();
        $data['totalAmount'] = $order->sum('final_amount');
     	return view('backend.partials.dashboard_data', $data);
	}
  
}

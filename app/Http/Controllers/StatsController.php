<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Product;
Use App\Order;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
class StatsController extends Controller
{
    public function index()
    {
    	$date2 = Carbon::now();
    	$date = Carbon::now()->subWeek(1);
        $orders = Order::orderBy('id', 'DESC')->where('status', '<>','not_processed')->where('status', '<>','pending')->where('status', '<>','Rejected')->where('date', '>', $date)->where('date', '<=', $date2)->with('user')->get();
        $approved= Order::where('status','approved')->where('date', '>', $date)->where('date', '<=', $date2)->count();
        $confirmed= Order::where('status','confirmed')->where('date', '>', $date)->where('date', '<=', $date2)->count();
        //Datos de las ordenes que se encontraron

        $total = 0;
        foreach ($orders as $order) {
        	if ($order->status=='confirmed') {
	            $total = $total + $order->total;
	        }
        }

        //Fin
        $days_total_cost = $this->calculatePieCharData();
      // $days_total = $this->calculateTotalPieCharData();
        if (Auth()->user()->level=='admin') {
return view('admin.stats.index', compact('orders', 'total', 'total_products', 'approved', 'confirmed', 'days_total_cost'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        } 
        
    }

    public function store(Request $request)
    {

        //Otener fecha inicio y fin
        $dates = explode(' - ', $request->get('date'));
        $ini_date = Carbon::createFromFormat('d/m/Y', $dates[0])->startOfDay();
        $end_date = Carbon::createFromFormat('d/m/Y', $dates[1])->endOfDay();
        //fin

        $orders = Order::where('status', '<>','not_processed')->where('status', '<>','pending')->where('status', '<>','Rejected')
            ->where('date', '>=', $ini_date)->where('date', '<=', $end_date)
            ->get();

        $approved= Order::where('status','approved')->where('date', '>=', $ini_date)->where('date', '<=', $end_date)->count();
        $confirmed= Order::where('status','confirmed')->where('date', '>=', $ini_date)->where('date', '<=', $end_date)->count();
        //Datos de las ordenes que se encontraron

        $total = 0;
        foreach ($orders as $order) {
            if ($order->status=='confirmed') {
                $total = $total + $order->total;
            }
        }

        //Fin
        $days_total_cost = $this->calculatePieCharData();
        $days_total = $this->calculateTotalPieCharData();
        if (Auth()->user()->level=='admin') {
return view('admin.stats.show', compact('orders', 'total', 'total_products', 'approved', 'confirmed', 'days_total_cost', 'ini_date', 'end_date'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        } 
        
    }

    private function calculatePieCharData()
    {
    	$date2 = Carbon::now();
    	$date = Carbon::now()->subWeek(1);
        $dt = Carbon::now()->subDay(1);
        $today = $dt->toDateTimeString();

        $orders = Order::where('status', 'confirmed')
            ->where('date', '>', $date)->where('date', '<=', $date2)
            ->get();

        $day_total_cost = 0;
        $days_total_cost = [];

        foreach ($orders as $order) {
            $day_total_cost = $day_total_cost + $order->total;
        }

        $days_total_cost = array_prepend($days_total_cost, $day_total_cost);

        for ($i = 1; $i < 8; $i++) {

            $day_total_cost = 0;

            $from = Carbon::now()->subDay($i)->toDateTimeString();
            $to = Carbon::now()->subDay($i - 1)->toDateTimeString();

            $orders = Order::where('status', 'confirmed')
                ->whereBetween('date', [$from, $to])
                ->get();
if (is_array($orders) || is_object($orders))
{
            foreach ($orders as $order) {
                $day_total_cost = $day_total_cost + $order->total;
            }
            $days_total_cost = array_prepend($days_total_cost, $day_total_cost);
           }
        }

        return $days_total_cost;
    }

    private function calculateTotalPieCharData()
    {
        $dt = Carbon::now()->subMonth(1);
        $today = $dt->toDateTimeString();

        $orders = Order::where('status', '<>', 'budget')
            ->where('created_at', '>', $today)
            ->get();

        $day_total = 0;
        $days_total = [];

        foreach ($orders as $order) {
             $day_total = $day_total + $order->total;
        }

        $days_total = array_prepend($days_total, $day_total);


        for ($i = 1; $i < 8; $i++) {

            $day_total = 0;

            $from = Carbon::now()->subMonth($i)->toDateTimeString();
            $to = Carbon::now()->subMonth($i - 1)->toDateTimeString();

            $orders = Order::where('status', '<>', 'budget')
                ->whereBetween('created_at', [$from, $to])
                ->get();

            foreach ($orders as $order) {
                $day_total = $day_total + $order->total;
            }
            $days_total = array_prepend($days_total, $day_total);
        }

        return $days_total;
    }

    public function spdf()
    {
        $date = Carbon::now()->format('d-m-Y');
        $products = Product::orderBy('type', 'ASC')->get();
        if (Auth()->user()->level=='admin') {
        return view('admin.stats.pdf', compact('products', 'date'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        } 
        
    }
}

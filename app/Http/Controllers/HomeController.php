<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Product;
Use App\Payment;
Use App\Order;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $orders = Order::orderBy('title', 'ASC')->get();
        $id = Auth()->user()->id;
        $orders = Order::orderBy('id', 'DESC')->where('status', 'approved')->where('user_id', $id)->get();
        $payments = Payment::orderBy('id', 'DESC')->where('user_id', $id)->get();

        foreach ($orders as $order) {
            if ($order->status=='approved') {
                $i=$order->id;
            $pay = Payment::orderBy('id', 'DESC')->where('order_id', $i)->sum('mount');
            $total = $order->total;
            if ($pay < $total) {
            Flash::success('Tiene un evento habilitado para realizar el pago correspondiente!')->important(); 
                }
            }
        }

        return view('home');
    }
}

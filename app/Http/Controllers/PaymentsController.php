<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentsRequest;
Use App\Payment;
Use App\Order;
use DB;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('id', 'DESC')->with('order')->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {	
    	$orders = Order::orderBy('id', 'DESC')->pluck('title', 'id')->all();
        return view('admin.payments.create', compact('orders'));
    }

    public function store(PaymentsRequest $request)
    {
        $request = $request->all();
        $payment = new Payment($request);
        //$payment->id=$p;
        $payment->save();
        $id=$request['order_id'];
        //dd($p);
        $order = Order::find($id);
    	//dd($order);
    	/*$sales = DB::table('payments')
            ->join('orders', 'orders.id', '=', 'payments.order_id')
            
            ->select(DB::raw('sum(orders.paid_out) AS total_sales'))
            ->where('orders.id', $id)
            ->get();
        $paids = $sales[0]->total_sales;*/
        $paids = $order->paid_out;
        $mount = $payment->mount;
        $request['paid_out'] = $mount + $paids;
        $paid = $request['paid_out'];
        $total = $order->total;
        if ($paid >= $total) {
        	$request['status'] = 'payment_received';
        }
        $order->update($request);
       // Flash::success('Se ha registrado el proveedor '. $payment->title. ' de manera exitosa!')->important();
        return redirect()->route('payments.index');
    }

    public function show($id)
    {
        $payment = Payment::find($id);
        return view('admin.payments.show', compact('payment'));
    }

    public function edit($id)
    {
    	$orders = Order::orderBy('id', 'DESC')->pluck('title', 'id')->all();
        $payment = Payment::find($id);
        return view('admin.payments.edit', compact('payment', 'orders'));
    }

    public function update(PaymentsRequest $request, $id)
    {
        $request = $request->all();
        $payment = Payment::find($id);
        $payment->update($request);
     //   flash('El proveedor '. $payment->name. ' ha sido editado con exito!!', 'success')->important();
        return redirect()->route('payments.index');
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        //flash('El proveedor '. $payment->name.' ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('payments.index');
    }

    public function pay()
    {	
    	
    	$payments = Payment::orderBy('id', 'DESC')->with('order')->get();
    	$orders = Order::orderBy('id', 'ASC')->get();
        //$request['total'] = $sales[0]->total_sales;

        return view('admin.payments.pay', compact('orders', 'orders'));
    }

    public function verified($id)
    {	

    	$payment = Payment::find($id);
    	$request['status'] = 'verified';
    	$payment->update($request);
    	$id=$payment->order_id;
    	$pay = Payment::orderBy('id', 'DESC')->where('order_id', $id)->where('status', 'verified')->sum('mount');
    	$order = Order::find($id);
    	$total = $order->total;
        if ($pay >= $total) {
        	$request['status'] = 'payment_verified';
        	$order->update($request);
        }
        
        //$request['total'] = $sales[0]->total_sales;
        return view('admin.payments.verified')->with('payment', $payment);
    }

    public function ppdf($id)
    {
        $payment = Payment::find($id);
        return view('admin.payments.pdf.ppdf', compact('payment'));
    }
}
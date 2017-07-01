<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentsRequest;
Use App\Payment;
use Laracasts\Flash\Flash;
Use App\Order;
Use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('id', 'DESC')->with('order')->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {	
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
    	$orders = Order::orderBy('id', 'DESC')->where('status', 'on_hold')->pluck('title', 'id')->all();
        return view('admin.payments.create', compact('orders', 'users'));
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
        $paids = $order->paid_out;
        $mount = $payment->mount;
        $request['paid_out'] = $mount + $paids;
        $paid = $request['paid_out'];
        $total = $order->total;
        if ($paid >= $total) {
        	$request['status'] = 'payment_received';
            Flash::success('EL PAGO FUE REGISTRADO CON EXITO, DEBE ESPERAR A QUE SEA CONFIRMADO!')->important(); 
        }else{
            $rest=$total-$paid;
            Flash::success('EL PAGO FUE REGISTRADO PERO ES INSUFICIENTE!.. Faltan '. $rest . ' BsF PARA COMPLETAR EL PAGO..!')->important();    
        }

        $order->update($request);

        return redirect()->route('payments.index');
    }

    public function show($id)
    {
        $payment = Payment::find($id);
        return view('admin.payments.show', compact('payment'));
    }

    public function edit($id)
    {
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
    	$orders = Order::orderBy('id', 'DESC')->pluck('title', 'id')->all();
        $payment = Payment::find($id);
        return view('admin.payments.edit', compact('payment', 'orders', 'users'));
    }

    public function update(PaymentsRequest $request, $id)
    {
        $request = $request->all();
        $payment = Payment::find($id);
        $payment->update($request);
        flash('El proveedor '. $payment->name. ' ha sido editado con exito!!', 'success')->important();
        return redirect()->route('payments.index');
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        flash('El pago ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('payments.index');
    }

    public function pay()
    {	
    	
    	$payments = Payment::orderBy('id', 'DESC')->with('order')->get();
    	$orders = Order::orderBy('id', 'ASC')->get();

        return view('admin.payments.pay', compact('orders', 'orders'));
    }

    public function verified($id)
    {	

    	$payment = Payment::find($id);
    	$request['status'] = 'payment_verified';
    	$payment->update($request);
    	$id=$payment->order_id;
    	$pay = Payment::orderBy('id', 'DESC')->where('order_id', $id)->where('status', 'payment_verified')->sum('mount');
    	$order = Order::find($id);
    	$total = $order->total;
        if ($pay >= $total) {
        	$request['status'] = 'payment_verified';
        	$order->update($request);
            Flash::success('EL PAGO FUE VERIFICADO CON EXITO, Y ESTA COMPLETO!')->important();
        }else{
        Flash::success('EL PAGO FUE VERIFICADO PERO ES INSUFICIENTE!.. POR FAVOR REVISE SI HAY MAS PAGOS REGISTRADOS SIN VERIFICAR PARA ESTE EVENTO')->important();    
        }

        return view('admin.payments.verified')->with('payment', $payment);
    }

    public function ppdf($id)
    {
        $payment = Payment::find($id);
        return view('admin.payments.pdf.ppdf', compact('payment'));
    }

    //MEMBERS
    public function indexpay()
    {
        $id = Auth()->user()->id;
        $payments = Payment::orderBy('id', 'DESC')->where('user_id', $id)->with('order')->get();
        return view('member.payments.index', compact('payments'));
    }

    public function createpay()
    {   
        $id = Auth()->user()->id;
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
        $orders = Order::orderBy('id', 'DESC')->where('user_id', $id)->where('status', 'on_hold')->pluck('title', 'id')->all();
        return view('member.payments.create', compact('orders', 'users'));
    }

    public function storepay(PaymentsRequest $request)
    {
        $request = $request->all();
        $request['user_id'] = Auth()->user()->id;
        $payment = new Payment($request);
        //$payment->id=$p;
        $payment->save();
        $id=$request['order_id'];
        //dd($p);
        $order = Order::find($id);
        $paids = $order->paid_out;
        $mount = $payment->mount;
        $request['paid_out'] = $mount + $paids;
        $paid = $request['paid_out'];
        $total = $order->total;
        if ($paid >= $total) {
            $request['status'] = 'payment_received';
            Flash::success('EL PAGO FUE REGISTRADO CON EXITO, DEBE ESPERAR A QUE SEA CONFIRMADO!')->important(); 
        }else{
            $rest=$total-$paid;
            Flash::success('EL PAGO FUE REGISTRADO PERO ES INSUFICIENTE!.. Faltan '. $rest . ' BsF PARA COMPLETAR EL PAGO..!')->important();    
        }

        $order->update($request);

        return redirect()->route('indexpay');
    }

    public function showpay($id)
    {
        $payment = Payment::find($id);
        return view('member.payments.show', compact('payment'));
    }

    public function memberpdf($id)
    {
        $order = Order::find($id);
        return view('member.orders.pdf.pdf', compact('order'));
    }

}
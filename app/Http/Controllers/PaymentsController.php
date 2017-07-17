<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentsRequest;
Use App\Payment;
use Laracasts\Flash\Flash;
Use App\Order;
Use App\Product;
use Carbon\Carbon;
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

    public function selectOrder()
    {
        $orders = Order::orderBy('id', 'DESC')->where('status', 'approved')->get();
        if (Auth()->user()->level=='admin') {
        return view('admin.payments.select_Order', compact('orders'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        } 
    }

    public function addpay($order)
    {	
        $order = Order::find($order);
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
        if (Auth()->user()->level=='admin') {
return view('admin.payments.create', compact('order', 'users'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        } 
        
    }

    public function store(PaymentsRequest $request)
    {
       $date = Carbon::now()->format('Y-m-d');

        $this->validate($request, [  
            'type'           => 'required', 
            'mount'          => 'required',
            'date'           => 'date|required|before_or_equal:'.$date,
        ]);

        $payment = Payment::create([
            'type' => $request->get('type'),
            'mount' => $request->get('mount'),
            'order_id' => $request->get('order_id'),
            'user_id' => Auth()->user()->id,
            'date' => $request->get('date'),
            'ref' => $request->get('ref'),
        ]);

        $payment->save();

        $id=$request['order_id'];

        Flash::success('Se ha registrado el pago de manera exitosa!')->important();
        return redirect()->route('payments.index');


        $request = $request->all();

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
        $orderid = $payment->order->id;
        $order= Order::find($orderid);
        if (Auth()->user()->level=='admin') {
        return view('admin.payments.show', compact('payment', 'order'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        } 
        
    }

    public function verified($id)
    {   

        $payment = Payment::find($id);
        $orderid = $payment->order->id;
        $order= Order::find($orderid);
        $request['status'] = 'verified';
        $payment->update($request);
        $id=$payment->order_id;
        $pay = Payment::orderBy('id', 'DESC')->where('order_id', $id)->where('status', 'verified')->sum('mount');
        $order = Order::find($id);
        $total = $order->total;
        if ($pay >= $total) {
            $request['status'] = 'confirmed';
            $order->update($request);

            //updating products
        $type=$order->type;
            $id=$order->id;
            $status=$order->status;
            $products = Product::orderBy('name', 'ASC')->get();
            //Selecting just ids from the pivot table that is related to the id of order
            foreach ($products as $product){
                $products_id = DB::table('order_product')
                    ->join('orders', 'orders.id', '=', 'order_product.order_id')
                    ->select('order_product.product_id AS ids')
                    ->where('order_product.product_id', $product->id)
                    ->where('order_product.order_id', $id)
                    ->get();
            
                    if ($product->type=='sale') {
                        foreach ($products_id as $product_id){
                            $quantity = DB::table('order_product')
                                ->join('products', 'products.id', '=', 'order_product.product_id')
                                ->select(DB::raw('sum(products.quantity-order_product.quantity) AS updated_quantity'))
                                ->where('order_product.order_id', $id)
                                ->where('products.id', $product_id->ids)
                                ->get();
                            $req = $quantity[0]->updated_quantity;
                            //available field
                            $available = DB::table('order_product')
                                ->join('products', 'products.id', '=', 'order_product.product_id')
                                ->select(DB::raw('sum(products.available-order_product.quantity) AS updated_available'))
                                ->where('order_product.order_id', $id)
                                ->where('products.id', $product_id->ids)
                                ->get();
                            $req2 = $available[0]->updated_available;

                            $product->update(['available' => $req2, 'quantity' => $req]);
                        }
                    }
                
            }
            Flash::success('EL PAGO FUE VERIFICADO CON EXITO, Y ESTA COMPLETO!')->important();
        }else{
        Flash::success('EL PAGO FUE VERIFICADO PERO ES INSUFICIENTE!.. POR FAVOR REVISE SI HAY MAS PAGOS REGISTRADOS SIN VERIFICAR PARA ESTE EVENTO')->important();    
        }
if (Auth()->user()->level=='admin') {
        return view('admin.payments.verified')->with('payment', $payment)->with('order', $order);
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        } 
        
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

    public function ppdf($id)
    {
        $payment = Payment::find($id);
        return view('admin.payments.pdf.ppdf', compact('payment'));
    }

    //MEMBERS
    public function indexpay()
    {
        $id = Auth()->user()->id;
        $payments = Payment::orderBy('id', 'DESC')->where('user_id', $id)->get();
        return view('member.payments.index', compact('payments'));
    }

    public function selectOrderMember()
    {

        $id = Auth()->user()->id;
        $orders = Order::orderBy('id', 'DESC')->where('status', 'approved')->where('user_id', $id)->get();
        return view('member.payments.select_Order', compact('orders'));
    }

    public function createpay($order)
    {   
        $id = Auth()->user()->id;
        $order = Order::find($order);
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
        return view('member.payments.create', compact('order', 'users'));
    }

    public function storepay(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');

        $this->validate($request, [  
            'type'           => 'required', 
            'mount'          => 'required',
            'date'           => 'date|required|before_or_equal:'.$date,
        ]);

        $payment = Payment::create([
            'type' => $request->get('type'),
            'mount' => $request->get('mount'),
            'date' => $request->get('date'),
            'order_id' => $request->get('order_id'),
            'locale' => $request->get('locale'),
            'user_id' => Auth()->user()->id,
            'ref' => $request->get('ref'),
        ]);

        $payment->save();

        Flash::success('Se ha registrado el pago de manera exitosa!')->important();
        return redirect()->route('indexpay');

    }

    public function showpay($id)
    {
        $payment = Payment::find($id);
        $orderid = $payment->order->id;
        $order= Order::find($orderid);
        return view('member.payments.show', compact('payment', 'order'));
    }

    public function memberpdf($id)
    {
        $order = Order::find($id);
        return view('member.orders.pdf.pdf', compact('order'));
    }

}
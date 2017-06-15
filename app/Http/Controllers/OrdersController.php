<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Order;
Use App\Product;
Use App\Provider;
Use App\User;
Use App\Calendar;
use Laracasts\Flash\Flash;
use DB;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('orders.create')->with('users', $users)->with('products', $products);
    }

 public function store(Request $request)
    {        

        $request = $request->all();
        $request['created'] = Auth()->user()->id;
        $request['updated'] = Auth()->user()->id;
        
        $order = new Order($request);       
        
        $order->save();
        $id=$order->id;

        $q = $request['quantity'];
        
        $p = $request['product_id'];
        
        $extra = array_map(function($q){
            return ['quantity' => $q];
        }, $q);
 
        $data = array_combine($p, $extra);
        foreach ($order->products as $valor) {
            dd($valor->name);
        }
        foreach ($order->products as $valor) {
            dd($valor->pivot->quantity);
        }

        $order->products()->sync($data);

       


        //$products = Product::where('id', $request['product_id']);
       // dd($request['type']);
       // $quantities=$request['quantity'];

     //   dd($quantity);
        //foreach ($products as $product){
         /*   if ($request['type'] == 'entry') {
                $quantity = DB::table('order_product')
        ->join('products', 'products.id', '=', 'order_product.product_id')
        ->select(DB::raw('sum(order_product.quantity*products.cost) AS total_sales'))
        ->where('order_product.order_id', $id)
        ->get();
                //foreach ($quantities as $quantity){
                    $product = Product::where('id', $request['product_id'])->increment('quantity', $request['quantity']);
            //DB::table('products')->where('id', $request['product_id'])->increment('quantity', $request['quantity']);
            }else{
                    $product = Product::where('id', $request['product_id'])->decrement('quantity', $request['quantity']);
            }*/
        //}
        /*$date=today;   EN EL INDEX DE PRODUCT PUEDE SER ( SI EXISTE ORDEN IGUAL A FECHA ACTUAL ACTUALIZAR ALLA)
        $product = Product::where('id', $request['product_id'])->increment('quantity', $request['quantity']);
        foreach $products as $product{
            if (product->type == entry && $date==request->date)
            product->quantity increment
        }
        */
 
        Flash::success('Se ha registrado la orden de manera exitosa!')->important();
        return redirect()->route('confirm', $order->id);
    }

    public function confirm($id)
    {
        $order = Order::find($id);
        $sales = DB::table('order_product')
        ->join('orders', 'orders.id', '=', 'order_product.order_id')
        ->join('products', 'products.id', '=', 'order_product.product_id')
        ->select(DB::raw('sum(order_product.quantity*products.cost) AS total_sales'))
        ->where('order_product.order_id', $id)
        ->get();
        $request['total'] = $sales[0]->total_sales;

        $order->update($request);
        $type=$order->type;
         //actualizacion de productos
        $j=$order->products->pivot->product_id;
        dd($j);
        if ($type == 'entry') {
        $products = Product::orderBy('name', 'ASC')->get();
        //dd($products);
        foreach ($products as $product){
        $quantity = DB::table('order_product')
        ->join('products', 'products.id', '=', 'order_product.product_id')
        ->select(DB::raw('sum(order_product.quantity+products.available) AS updated_quantity'))
        ->where('order_product.order_id', $id)
        ->where('products.id', $product->id)
        ->get();
        $req = $quantity[0]->updated_quantity;
        
        $product->where('id', $request['product_id'])->update(['available' => $req]);
            }
                //foreach ($quantities as $quantity){
                    
            //DB::table('products')->where('id', $request['product_id'])->increment('quantity', $request['quantity']);
            }else{
                    $product = Product::where('id', $request['product_id'])->decrement('quantity', $request['quantity']);
            }

        //dd($sales[0]->total_sales);
       // $request['total'] = $sales[0]->total_sales;
        return view('orders.confirm')->with('order', $order)->with('sales', $sales);   
      //  return redirect()->route('orders.index');
    }

    public function show($id)
    {
      //  $users = User::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $order = Order::find($id);
        $sales = DB::table('order_product')
        ->join('orders', 'orders.id', '=', 'order_product.order_id')
        ->join('products', 'products.id', '=', 'order_product.product_id')
        ->select(DB::raw('sum(order_product.quantity*products.cost) AS total_sales'))
        ->where('order_product.order_id', $id)
        ->get();

    return view('orders.show')->with('order', $order)->with('sales', $sales);
    }

    public function edit($id)
    {
        $order= Order::find($id);
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $my_products = $order->products->pluck('id')->toArray();
        return view('orders.edit')->with('users', $users)->with('products', $products)->with('order', $order)->with('my_products', $my_products);
    }

    public function update(Request $request, order $order)
    {
        $request = $request->all();
        $request['updated'] = Auth()->user()->id;
        $sales = DB::table('order_product')
        ->join('orders', 'orders.id', '=', 'order_product.order_id')
        ->join('products', 'products.id', '=', 'order_product.product_id')
        ->select(DB::raw('sum(order_product.quantity*products.cost) AS total_sales'))
        ->where('products.id', '=', $request['product_id'])
        ->get();   
        $order->update($request);
        $id=$order->id;
        $q = $request['quantity'];
        $p = $request['product_id'];
        $extra = array_map(function($q){
            return ['quantity' => $q];
        }, $q);
 
        $data = array_combine($p, $extra);
        foreach ($order->products as $valor) {
        }

        $order->products()->sync($data);
 
        Flash::success('Se ha registrado la orden de manera exitosa!')->important();
        return redirect()->route('confirm', $order->id);
    }

    public function destroy($id)
    {
        //
    }

    public function calendar()
    {

        
        $events = [];
        $orders= Order::orderBy('id', 'DESC')->get();
        foreach ($orders as $order) {
    
        $events[] = \Calendar::event(
            $order->title, //event title
            true, //full day event?
            $order->date, //start time (you can also use Carbon instead of DateTime)
            $order->date, //end time (you can also use Carbon instead of DateTime)
            0, //optionally, you can specify an event ID
            [
        'url' => 'orders/show', $order->id,
        //any other full-calendar supported parameters
    ]
             
        );
        }
        $calendar = \Calendar::addEvents($events); 

        return view('orders.calendar.calendar', compact('calendar'));
       
        /* $events= Order::orderBy('id', 'DESC')->get();
      //   $events->toArray();
         dd($events);
        //$eloquentEvent = EventModel::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event

        $calendar = \Calendar::addEvents($events); 

        return view('orders.calendar.calendar', compact('calendar'));*/

    }


}

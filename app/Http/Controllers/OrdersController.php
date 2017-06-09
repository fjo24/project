<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Order;
Use App\Product;
Use App\Provider;
Use App\User;
use Laracasts\Flash\Flash;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->get();
       // dd($products);
        return view('orders.create')->with('users', $users)->with('products', $products);
    }

    public function store(Request $request)
    {

        $request = $request->all();
        $request['created'] = Auth()->user()->id;
        $request['updated'] = Auth()->user()->id;
        $order = new Order($request);
        $order->save();
        $product = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();

       // return view('orders.store')->with('order', $order)->with('product', $product);
      //  Flash::success('Se ha registrado el producto '. $product->name. ' de manera exitosa!')->important();
        return redirect()->route('createpivot', $order->id);
    }

    public function createpivot($id){
    
    $order = Order::find($id);
    $clave = $order['id'];
    //dd($clave);
    $product = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();

    //return redirect()->route('orders.createpivot', $order->id)->with('order', $order)->with('product', $product);
    return view('orders.createpivot')->with('order', $order)->with('product', $product)->with('clave', $clave);
    //return view('orders.createpivot', compact('order', 'product'));
    }
//
    public function storepivot(Request $request){
    dd($request['clave']);

    $request = $request->all();
    /*$request['product_id'] = Auth()->user()->id;
    $request['updated'] = Auth()->user()->id;
    $pivot = new Pivot::($request);*/
  //  $order->products()->attach($sector , array( 'fecha' => Input::get('fecha'), 'tareas' => Input::get('tareas')));
    $order->products()->attach('order_id',['product_id'=>Input::get('fecha'), 'quantity'=>Input::get('quantity')]);
    //$order->products()->sync($request['product_id']);
    //$order->products()->sync($request['quantity']);
    $order->save();

      //  Flash::success('Se ha registrado el producto '. $product->name. ' de manera exitosa!')->important();
    return redirect()->route('orders.index');

    }

    public function show($id)
    {
        $users = User::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $orders = Product::orderBy('name', 'ASC')->get();
        // dd($products);
        return view('orders.create')->with('users', $users)->with('orders', $orders);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

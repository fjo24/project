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
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
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
        $q = $request['quantity'];
        $p = $request['product_id'];
        
        $extra = array_map(function($q){
            return ['quantity' => $q];
        }, $q);

        $data = array_combine($p, $extra);
        foreach ($order->products as $valor) {
            dd($valor->name);
        }

        //dd($data);
        $order->products()->sync($data);

      /*  foreach ($order->products as $valor) {
            $c = $valor->cost_c*$valor->pivov->quantity;
            dd($c);
        }*/

       // return view('orders.store')->with('order', $order)->with('product', $product);
        Flash::success('Se ha registrado la orden de manera exitosa!')->important();
        return redirect()->route('orders.index');
    }

    public function show($id)
    {
        $users = User::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $orders = Product::orderBy('name', 'ASC')->get();
        // dd($products);
        return view('orders.show')->with('users', $users)->with('orders', $orders);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Product;
Use App\Order;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use DB;

class HomeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        $date = Carbon::now()->format('d-m-Y');
        $orders = Order::orderBy('title', 'ASC')->get();

        foreach ($products as $product){
        $mount=$product->quantity;
        $product->update(['available' => $mount]);
    }
        
foreach ($orders as $order){
            $type=$order->type;
            $id=$order->id;
            $products = Product::orderBy('name', 'ASC')->get();
            //Selecting just ids from the pivot table that is related to the id of order

            foreach ($products as $product){
                $products_id = DB::table('order_product')
                    ->join('orders', 'orders.id', '=', 'order_product.order_id')
                    ->select('order_product.product_id AS ids')
                    ->where('order_product.product_id', $product->id)
                    ->where('order_product.order_id', $id)
                    ->get();
                if ($date >= $order->date) {
                    if ($type=='service') {
                        //SUM mounts of id selected..
                        //quantity field
                            if ($product->type=='rent') {
                            foreach ($products_id as $product_id){
                                $quantity = DB::table('order_product')
                                    ->join('products', 'products.id', '=', 'order_product.product_id')
                                    ->select(DB::raw('sum(products.available-order_product.quantity) AS updated_quantity'))
                                    ->where('order_product.order_id', $id)
                                    ->where('products.id', $product_id->ids)
                                    ->get();
                                $req = $quantity[0]->updated_quantity;
                                $product->update(['available' => $req]);
                            }
                        }elseif ($product->type=='sale') {
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
                }
            }
        }
        return view('home');
    }
}

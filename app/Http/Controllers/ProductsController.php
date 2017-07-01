<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Product;
Use App\Order;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Http\Requests\ProductRequest;
use DB;

class ProductsController extends Controller
    {

     public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        $date = Carbon::now()->format('d-m-Y');
        $orders = Order::orderBy('title', 'ASC')->get();
        foreach ($products as $product){
            if ($product->type=='rent') {
        $mount=$product->quantity;
        $product->update(['available' => $mount]);
    }
    }

        
foreach ($orders as $order){
            $type=$order->type;
            $id=$order->id;
            $status=$order->status;
            $date_order = $order->date;
            $products = Product::orderBy('name', 'ASC')->get();
            //Selecting just ids from the pivot table that is related to the id of order
            foreach ($products as $product){
                $products_id = DB::table('order_product')
                    ->join('orders', 'orders.id', '=', 'order_product.order_id')
                    ->select('order_product.product_id AS ids')
                    ->where('order_product.product_id', $product->id)
                    ->where('order_product.order_id', $id)
                    ->get();
                if ($date == $order->date) {
                    if ($status=='confirmed') {
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
                        }
                    }
                }
            }

        
        }
          
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(ProductRequest $request)
    {
        $request = $request->all();
        $product = new Product($request);
        $product->save();
        //Flash::success('Se ha registrado el producto '. $product->name. ' de manera exitosa!')->important();
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, product $product)
    {
        $request = $request->all();
        $product->update($request);
        //flash('El producto '. $product->name. ' ha sido editado con exito!!', 'success')->important();
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        //flash('El producto '. $product->name.' ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('products.index');
    }

    public function modal()
    {
        return view('admin.products.modal');
        
    }

    // products from member users
    public function indexproducts()
    {
        $products = Product::orderBy('type', 'DESC')->get();
          
        return view('member.products.index', compact('products'));
    }

    public function showproduct($id)
    {
        $product = Product::find($id);
          
        return view('member.products.show', compact('product'));
    }

}
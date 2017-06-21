<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Order;
Use App\Product;
use App\Http\Requests\OrderRequest;
Use App\Provider;
Use App\User;
Use App\Calendar;
//use Laracasts\Flash\Flash;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }
    
    public function depot()
    {
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
        $providers = Provider::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('admin.orders.create')->with('users', $users)->with('products', $products)->with('providers', $providers);
    }    

    public function create()
    {
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
        $providers = Provider::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('admin.orders.create')->with('users', $users)->with('products', $products)->with('providers', $providers);
    }

    public function store(OrderRequest $request)
    {
        $date = Carbon::now()->format('Y-m-d');
        $request = $request->all();
        $request['created'] = Auth()->user()->id;
        $request['updated'] = Auth()->user()->id;
        $request['date'] = $date;
        $order = new Order($request);
        $order->save();

        $id=$order->id;
        $q = $request['quantity'];
        $p = $request['product_id'];
        //formating array
        $extra = array_map(function($q){
            return ['quantity' => $q];
        }, $q);
        //combining array
        $data = array_combine($p, $extra);
        //ready to sync
        $order->products()->sync($data);

      //  Flash::success('Se ha registrado la orden de manera exitosa!')->important();
        return redirect()->route('confirm', $order->id);
    }

    public function confirm($id)
    {
        $order = Order::find($id);
        //updating total field
        if ($order->type=='service') {
        $sales = DB::table('order_product')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->select(DB::raw('sum(order_product.quantity*products.cost) AS total_sales'))
            ->where('order_product.order_id', $id)
            ->get();
        $request['total'] = $sales[0]->total_sales;
        //$order->products;
        $order->update($request);
        }else{
            $sales=0;
        }
        //updating depot of products
        $type=$order->type;
        $products = Product::orderBy('name', 'ASC')->get();
        //Selecting just ids from the pivot table that is related to the id of order
        foreach ($products as $product){
            $products_id = DB::table('order_product')
                ->join('orders', 'orders.id', '=', 'order_product.order_id')
                ->select('order_product.product_id AS ids')
                ->where('order_product.product_id', $product->id)
                ->where('order_product.order_id', $id)
                ->get();
            if ($type=='entry') {
                //SUM mounts of id selected..
                //quantity field
                foreach ($products_id as $product_id){
                    $quantity = DB::table('order_product')
                        ->join('products', 'products.id', '=', 'order_product.product_id')
                        ->select(DB::raw('sum(order_product.quantity+products.quantity) AS updated_quantity'))
                        ->where('order_product.order_id', $id)
                        ->where('products.id', $product_id->ids)
                        ->get();
                    $req = $quantity[0]->updated_quantity;
                    //available field
                    $available = DB::table('order_product')
                        ->join('products', 'products.id', '=', 'order_product.product_id')
                        ->select(DB::raw('sum(order_product.quantity+products.available) AS updated_available'))
                        ->where('order_product.order_id', $id)
                        ->where('products.id', $product_id->ids)
                        ->get();
                    $req2 = $available[0]->updated_available;
                    $product->update(['available' => $req2, 'quantity' => $req]);
                }
            }elseif ($type=='remove') {
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
        return view('admin.orders.confirm')->with('order', $order)->with('sales', $sales);

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

        return view('admin.orders.show')->with('order', $order)->with('sales', $sales);
    }

    public function edit($id)
    {
        $order= Order::find($id);
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
        $providers = Provider::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $my_products = $order->products->pluck('id')->toArray();
        return view('admin.orders.edit')->with('users', $users)->with('products', $products)->with('order', $order)->with('my_products', $my_products)->with('providers', $providers);
    }

    public function update(OrderRequest $request, order $order)
    {
        $request = $request->all();
        $request['updated'] = Auth()->user()->id;
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

     //   Flash::success('Se ha registrado la orden de manera exitosa!')->important();
        return redirect()->route('confirm', $order->id);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
       // flash('La orden ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('orders.index');
    }

    public function calendar()
    {
        $events = [];
        $orders= Order::orderBy('id', 'DESC')->get();
        foreach ($orders as $order) {
            if ($order->type=='service' && $order->status=='confirmed') {
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
        }
        $calendar = \Calendar::addEvents($events);
        return view('admin.orders.calendar.calendar', compact('calendar'));


    }

    public function pdf($id)
    {
        $order = Order::find($id);
        return view('admin.orders.pdf.pdf', compact('order'));
    }

    public function indexconfirmed()
    {
        $orders = Order::orderBy('id', 'DESC')->with('user')->get();
        return view('admin.orders.indexconfirmed', compact('orders'));
    }

    public function createevent()
    {
        $users = User::orderBy('fullname', 'ASC')->pluck('fullname', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('admin.orders.createevent')->with('users', $users)->with('products', $products);
    }

    public function storeevent(OrderRequest $request)
    {
        $request = $request->all();
        $request['created'] = Auth()->user()->id;
        if (Auth::user()->level=='member') {
        $request['user_id'] = Auth()->user()->id;
        }
        $request['updated'] = Auth()->user()->id;
        $request['status'] = 'on_hold';
        $order = new Order($request);
        $order->save();

        $id=$order->id;
        $q = $request['quantity'];
        $p = $request['product_id'];
        //formating array
        $extra = array_map(function($q){
            return ['quantity' => $q];
        }, $q);
        //combining array
        $data = array_combine($p, $extra);
        //ready to sync
        $order->products()->sync($data);

      //  Flash::success('Se ha registrado la orden de manera exitosa!')->important();
        return redirect()->route('confirm', $order->id);
    }

    public function eventconfirmed($id)
    {
        $order = Order::find($id);
        $request['status'] = 'confirmed';
        $order->update($request);

        $products = Product::orderBy('id', 'DESC')->get();
        $date = Carbon::now()->format('d-m-Y');
        


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
              
                    if ($type=='service' && $status=='confirmed') {
                        //SUM mounts of id selected..
                        //quantity field
                            if ($product->type=='sale') {
                            foreach ($products_id as $product_id){
                                $quantity = DB::table('order_product')
                                    ->join('products', 'products.id', '=', 'order_product.product_id')
                                    ->select(DB::raw('sum(products.available-order_product.quantity) AS updated_available'))
                                    ->where('order_product.order_id', $id)
                                    ->where('products.id', $product_id->ids)
                                    ->get();
                                $req = $quantity[0]->updated_available;

                                $quantity = DB::table('order_product')
                                    ->join('products', 'products.id', '=', 'order_product.product_id')
                                    ->select(DB::raw('sum(products.quantity-order_product.quantity) AS updated_quantity'))
                                    ->where('order_product.order_id', $id)
                                    ->where('products.id', $product_id->ids)
                                    ->get();
                                $req1 = $quantity[0]->updated_quantity;

                                $product->update(['available' => $req, 'quantity' => $req1]);
                            }
                        }
                    }
       
            }
        
           // Flash::success('EVENTO CONFIRMADO!')->important();
        return redirect()->route('indexconfirmed', $order->id);
}
}

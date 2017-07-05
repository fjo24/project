<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Order;
Use App\Product;
use App\Http\Requests\OrderRequest;
Use App\Provider;
Use App\User;
Use App\Event;
Use App\Calendar;
Use App\Payment;
Use App\Configuration;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
class OrdersController extends Controller
{

    public function index()
    {

        $events = Order::orderBy('id', 'ASC')->where('status', 'confirmed')->get();
        $orders = Order::orderBy('id', 'ASC')->where('status', '<>', 'confirmed')->get();
        $products = Product::orderBy('id', 'DESC')->get();

    foreach ($orders as $order) {
        $a = 0;
        $b = 0;
        $id2 = $order->id;
        $order->availability='y';
$order->update();

     
                        //selecting id products of events with status confirmed
    foreach ($products as $product){
        

        if($product->type=='rent'){
            $prod_orders = DB::table('order_product')
                                ->join('orders', 'orders.id', '=', 'order_product.order_id')
                                ->select('order_product.product_id AS ids')
                                ->where('order_product.product_id', $product->id)
                                ->where('order_product.order_id', $id2)
                                ->get();
            foreach ($prod_orders as $prod_order){
                                            $quantity2 = DB::table('order_product')
                                                ->join('products', 'products.id', '=', 'order_product.product_id')
                                                ->select(DB::raw('order_product.quantity AS updated_quantity2'))
                                                ->where('order_product.order_id', $id2)
                                                ->where('products.id', $prod_order->ids)
                                                ->get();
                                            $req2 = $quantity2[0]->updated_quantity2;
                                            
                                       

                            foreach ($events as $event){

                                $event->availability='y';
                                $id = $event->id;
                                $dat = $event->date;

                                if ($dat==$order->date) {
                                    $prod_events = DB::table('order_product')
                                ->join('orders', 'orders.id', '=', 'order_product.order_id')
                                ->select('order_product.product_id AS ids')
                                ->where('order_product.product_id', $product->id)
                                ->where('order_product.order_id', $id)
                                ->get();
                                   

                                
                            //if ($status=='confirmed') {
                                //SUM mounts of id selected..
                                //quantity field
                                    foreach ($prod_events as $p_event){
                                        //confirmed
                                        $quantity = DB::table('order_product')
                                            ->join('products', 'products.id', '=', 'order_product.product_id')
                                            ->select(DB::raw('order_product.quantity AS updated_quantity'))
                                            ->where('order_product.order_id', $id)
                                            ->where('products.id', $p_event->ids)
                                            ->get();
                                        $req = $quantity[0]->updated_quantity;
                                        $available = $product->quantity-$req;
                                        //no confirmed
                                        if($req2 >= $available){
                                            //  dd('si');
                                            $order->availability='n';
                                            $order->update();
                                            // $order->update(['availability' => 'n']);
                                            }
                                    }
                                    
                                } //endif
                            } //events
 }
                    }elseif ($product->type=='sale') {
                        # code...
                        $prod_orders = DB::table('order_product')
                            ->join('orders', 'orders.id', '=', 'order_product.order_id')
                            ->select('order_product.product_id AS ids')
                            ->where('order_product.product_id', $product->id)
                            ->where('order_product.order_id', $id2)
                            ->get();
                    foreach ($prod_orders as $prod_order){
                        $quantity2 = DB::table('order_product')
                            ->join('products', 'products.id', '=', 'order_product.product_id')
                            ->select(DB::raw('order_product.quantity AS updated_quantity2'))
                            ->where('order_product.order_id', $id2)
                            ->where('products.id', $prod_order->ids)
                            ->get();
                        $req2 = $quantity2[0]->updated_quantity2;
                            if($req2 >= $product->quantity){
                            //  dd('si');
                            $order->availability='n';
                            $order->update();
                        // $order->update(['availability' => 'n']);
                        } 
                    }
                }//else type
            } //products
        }//orders

        return view('admin.orders.index', compact('orders', 'events'));
    }

    public function selectClient()
    {
        $users = User::orderBy('fullname', 'DESC')->get();

        return view('admin.orders.select_client', compact('users'));
    }
    
    public function addorder($user)
    {
        $user = User::find($user);
        $events = Event::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $aux = Product::orderBy('name', 'ASC')->get();
        $prod = $aux->toJson();
        $config = Configuration::first();
        return view('admin.orders.create')->with('user', $user)->with('config', $config)->with('products', $products)->with('prod', $prod)->with('events', $events);
    }

    public function store(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');

        $this->validate($request, [
            'title'      => 'max:100|required',
            'event_id'   => 'required',
            'date'       => 'date|required|after_or_equal:'.$date,
            'locale'     => 'required|max:200',
        ]);

        $order = Order::create([
            'title' => $request->get('title'),
            'date' => $request->get('date'),
            'user_id' => $request->get('user_id'),
            'event_id' => $request->get('event_id'),
            'locale' => $request->get('locale'),
            'notes' => $request->get('notes'),
            'neto' => $request->get('neto'),
            'iva' => $request->get('iva'),
            'total' => $request->get('total'),
            'discount' => $request->get('discount'),
            'created' => Auth()->user()->id,
            'updated' => Auth()->user()->id,
        ]);

        for ($i = 0; $i < count($request->product_id); $i++) {
            $order->products()->attach($request->product_id[$i], ['quantity' => $request->quantity[$i]]);
        }

        $order->save();

        Flash::success('Se ha registrado la orden de manera exitosa!')->important();
        return redirect()->route('orders.show', $order->id);

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

        $net = ($order->total*10)/90;

        return view('admin.orders.show')->with('order', $order)->with('sales', $sales)->with('net', $net);
    }

    public function edit($id)
    {
        $order= Order::find($id);

        $iduser = $order->user_id;
        $user = User::find($iduser);

        $events = Event::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $aux = Product::orderBy('name', 'ASC')->get();
        $prod = $aux->toJson();
        $config = Configuration::first();
        return view('admin.orders.edit')->with('config', $config)->with('order', $order)->with('products', $products)->with('prod', $prod)->with('events', $events)->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $date = Carbon::now()->format('Y-m-d');

        $this->validate($request, [
            'title'      => 'max:100|required',
            'event_id'   => 'required',
            'date'       => 'date|required|after_or_equal:'.$date,
            'locale'     => 'required|max:200',
        ]);

        $order = Order::find($id);

        if ($order->products()->count() > 0) {
            $order->products()->detach();
        }

        for ($i = 0; $i < count($request->product_id); $i++) {
            $order->products()->attach($request->product_id[$i], ['quantity' => $request->quantity[$i]]);
        }

        $order->title = $request->get('title');
        $order->date = $request->get('date');
        $order->user_id = $request->get('user_id');
        $order->event_id = $request->get('event_id');
        $order->iva = $request->get('iva');
        $order->total = $request->get('total');
        $order->locale = $request->get('locale');
        $order->discount = $request->get('discount');
        $order->notes = $request->get('notes');
        $order->neto = $request->get('neto');
        $order->updated = Auth()->user()->id;

        $order->save();

        Flash::success('Se ha editado la orden de manera exitosa!')->important();
        return redirect()->route('orders.show', $order->id);

    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        flash('La orden ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('orders.index');
    }

    public function calendar()
    {
        $events = [];
        $orders= Order::orderBy('id', 'DESC')->get();
        foreach ($orders as $order) {
            if ($order->status=='confirmed') {
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

    public function eventconfirmed($id)
    {
        $order = Order::find($id);
        $request['status'] = 'confirmed';
        $order->update($request);
        $products = Product::orderBy('id', 'DESC')->get();
        $date = Carbon::now()->format('d-m-Y');

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
                    if ($status=='confirmed') {
                        //SUM mounts of id selected..
                        //quantity field                            
                  /*  if ($order->date==$date) {
                        if ($product->type=='rent') {
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
                }*/
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
            }
            Flash::success('Se ha CONFIRMADO el evento de manera exitosa!')->important();
        return redirect()->route('orders.index', $order->id);    
       // return view('admin.orders.show')->with('order', $order);
    }

    public function reconfirmed($id)
    {
        $order = Order::find($id);

        return view('admin.orders.reconfirmed')->with('order', $order);    
       // return view('admin.orders.show')->with('order', $order);
    }

    //products for users of type member                      <<<MEMBER>>><<<MEMBER>>><<<MEMBER>>>

    public function indexorder()
    {
        $id = Auth()->user()->id;
        $orders = Order::orderBy('id', 'DESC')->where('user_id', $id)->get();
        return view('member.orders.index', compact('orders'));
    }

    public function createorder()
    {
        $user = Auth()->user();
        $events = Event::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $aux = Product::orderBy('name', 'ASC')->get();
        $prod = $aux->toJson();
        $config = Configuration::first();
        return view('member.orders.create')->with('user', $user)->with('config', $config)->with('products', $products)->with('prod', $prod)->with('events', $events);
    }

    public function storeorder(OrderRequest $request)
    {
        $date = Carbon::now()->format('Y-m-d');

        $this->validate($request, [
            'title'      => 'max:100|required',
            'event_id'   => 'required',
            'date'       => 'date|required|after_or_equal:'.$date,
            'locale'     => 'required|max:200',
        ]);

        $order = Order::create([
            'title' => $request->get('title'),
            'date' => $request->get('date'),
            'user_id' => $request->get('user_id'),
            'event_id' => $request->get('event_id'),
            'locale' => $request->get('locale'),
            'notes' => $request->get('notes'),
            'neto' => $request->get('neto'),
            'iva' => $request->get('iva'),
            'total' => $request->get('total'),
            'discount' => $request->get('discount'),
            'created' => Auth()->user()->id,
            'updated' => Auth()->user()->id,
        ]);


        for ($i = 0; $i < count($request->product_id); $i++) {
            $order->products()->attach($request->product_id[$i], ['quantity' => $request->quantity[$i]]);
        }


        //$order->products()->attach(1, ['quantity' => $request->get('product_quantity'), 'price' => $request->get('product_price')]);

        $order->save();

        Flash::success('Se ha registrado la orden de manera exitosa!')->important();
        return redirect()->route('showorder', $order->id);
    }

    public function editorder($id)
    {
    
        $order= Order::find($id);

        $iduser = $order->user_id;
        $user = User::find($iduser);

        $events = Event::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $aux = Product::orderBy('name', 'ASC')->get();
        $prod = $aux->toJson();
        $config = Configuration::first();
        return view('member.orders.edit')->with('config', $config)->with('order', $order)->with('products', $products)->with('prod', $prod)->with('events', $events)->with('user', $user);
    }

    public function updateorder(OrderRequest $request, order $order, $id)
    {

        $date = Carbon::now()->format('Y-m-d');

        $this->validate($request, [
            'title'      => 'max:100|required',
            'event_id'   => 'required',
            'date'       => 'date|required|after_or_equal:'.$date,
            'locale'     => 'required|max:200',
        ]);

        $order = Order::find($id);

        if ($order->products()->count() > 0) {
            $order->products()->detach();
        }

        for ($i = 0; $i < count($request->product_id); $i++) {
            $order->products()->attach($request->product_id[$i], ['quantity' => $request->quantity[$i]]);
        }

        $order->title = $request->get('title');
        $order->date = $request->get('date');
        $order->user_id = $request->get('user_id');
        $order->event_id = $request->get('event_id');
        $order->iva = $request->get('iva');
        $order->total = $request->get('total');
        $order->locale = $request->get('locale');
        $order->notes = $request->get('notes');
        $order->neto = $request->get('neto');
        $order->updated = Auth()->user()->id;

        $order->save();

        Flash::success('Se ha editado la orden de manera exitosa!')->important();
        return redirect()->route('showorder', $order->id);

    }

    public function total($id)
    {
        $order = Order::find($id);
        //updating total field
        
        $sales = DB::table('order_product')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->select(DB::raw('sum(order_product.quantity*products.cost) AS total_sales'))
            ->where('order_product.order_id', $id)
            ->get();
        $request['total'] = $sales[0]->total_sales;
        //$order->products;
        //dd($request['total']);
        $order->update($request);
        //products
        $status=$order->status;
        $products = Product::orderBy('name', 'ASC')->get();
            //Selecting just ids from the pivot table that is related to the id of order

    return redirect()->route('showorder', $order->id);
}

    public function showorder($id)
    {
        //  $users = User::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $order = Order::find($id);
        $sales = DB::table('order_product')
            ->join('orders', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'products.id', '=', 'order_product.product_id')
            ->select(DB::raw('sum(order_product.quantity*products.cost) AS total_sales'))
            ->where('order_product.order_id', $id)
            ->get();

        return view('member.orders.show')->with('order', $order)->with('sales', $sales);
    }

    //estado de los eventos

    public function approvedEvent($id)
    {   
        $order = Order::find($id);
        $request['status'] = 'approved';
        $order->update($request);
        
        Flash::success('LA orden paso a APROBADA.. Ya se puede realizar el pago correspondiente')->important();    
        return view('admin.orders.status.approved')->with('order', $order);
    }

    public function rejectedEvent($id)
    {   
        $order = Order::find($id);
        $request['status'] = 'rejected';
        $order->update($request);
        
        Flash::success('LA orden paso a RECHAZADA..')->important();    
        return view('admin.orders.status.rejected')->with('order', $order);
    }
}
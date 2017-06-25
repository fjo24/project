<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Register;
Use App\Product;
Use App\Provider;
Use App\User;
use Carbon\Carbon;
use DB;
use Laracasts\Flash\Flash;
use App\Http\Requests\RegistersRequest;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
class RegistersController extends Controller
{

    public function index()
    {
        $registers = Register::orderBy('id', 'DESC')->get();
        return view('admin.registers.index', compact('registers'));
    }

    public function create()
    {
        $providers = Provider::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->orWhere('type', 'rent')->orWhere('type', 'sale')->pluck('name', 'id')->all();
        return view('admin.registers.create', compact('providers', 'products'));
    }

    public function store(RegistersRequest $request)
    {           

        $request = $request->all();
        $request['created'] = Auth()->user()->id;
        $request['updated'] = Auth()->user()->id;
      /*  if ($request['type']=='remove') {
            $request['provider_id'] = Auth()->user()->id;
        }*/
        $register = new Register($request);
        $register->save();

        $id=$register->id;
        $q = $request['quantity'];
        $p = $request['product_id'];
        //formating array
        $extra = array_map(function($q){
            return ['quantity' => $q];
        }, $q);
        //combining array
        $data = array_combine($p, $extra);
        //ready to sync
        $register->products()->sync($data);


        // Flash::success('Se ha registrado la orden de manera exitosa!')->important();
        return redirect()->route('confirmregister', $register->id);


/*
        $request = $request->all();
        $register = new Register($request);
        $register->save();
        if ($request['type'] == 'entry') {
        $product = Product::where('id', $request['product_id'])->increment('quantity', $request['quantity']);
        } else {
        $product = Product::where('id', $request['product_id'])->decrement('quantity', $request['quantity']);
        }

        /*$date=today;   EN EL INDEX DE PRODUCT PUEDE SER ( SI EXISTE ORDEN IGUAL A FECHA ACTUAL ACTUALIZAR ALLA)
        $product = Product::where('id', $request['product_id'])->increment('quantity', $request['quantity']);
        foreach $products as $product{
            if (product->type == entry && $date==request->date)
            product->quantity increment
        }
        
        Flash::success('Se ha registrado de manera exitosa!')->important();
        return redirect()->route('admin.registers.index');*/
    }

    public function confirmregister($id)
    {
        $register = Register::find($id);
        //updating total field
        //    $sales=0;
        
        //updating depot of products
        $type=$register->type;
     
        $products = Product::orderBy('name', 'ASC')->get();
        //Selecting just ids from the pivot table that is related to the id of order
        foreach ($products as $product){
            $products_id = DB::table('product_register')
                ->join('registers', 'registers.id', '=', 'product_register.register_id')
                ->select('product_register.product_id AS ids')
                ->where('product_register.product_id', $product->id)
                ->where('product_register.register_id', $id)
                ->get();
            if ($type=='entry') {
                //SUM mounts of id selected..
                //quantity field
                foreach ($products_id as $product_id){
                    $quantity = DB::table('product_register')
                        ->join('products', 'products.id', '=', 'product_register.product_id')
                        ->select(DB::raw('sum(product_register.quantity+products.quantity) AS updated_quantity'))
                        ->where('product_register.register_id', $id)
                        ->where('products.id', $product_id->ids)
                        ->get();
                    $req = $quantity[0]->updated_quantity;
                    //available field
                    $available = DB::table('product_register')
                        ->join('products', 'products.id', '=', 'product_register.product_id')
                        ->select(DB::raw('sum(product_register.quantity+products.available) AS updated_available'))
                        ->where('product_register.register_id', $id)
                        ->where('products.id', $product_id->ids)
                        ->get();
                    $req2 = $available[0]->updated_available;
                    $product->update(['available' => $req2, 'quantity' => $req]);
                }
            }elseif ($type=='remove') {
                foreach ($products_id as $product_id){
                    $quantity = DB::table('product_register')
                        ->join('products', 'products.id', '=', 'product_register.product_id')
                        ->select(DB::raw('sum(products.quantity-product_register.quantity) AS updated_quantity'))
                        ->where('product_register.register_id', $id)
                        ->where('products.id', $product_id->ids)
                        ->get();
                    $req = $quantity[0]->updated_quantity;
                    //available field
                    $available = DB::table('product_register')
                        ->join('products', 'products.id', '=', 'product_register.product_id')
                        ->select(DB::raw('sum(products.available-product_register.quantity) AS updated_available'))
                        ->where('product_register.register_id', $id)
                        ->where('products.id', $product_id->ids)
                        ->get();
                    $req2 = $available[0]->updated_available;

                    $product->update(['available' => $req2, 'quantity' => $req]);
                }
            }
        }
        return view('admin.registers.confirmregister')->with('register', $register);
    }

    public function rpdf($id)
    {
        $register = Register::find($id);
        return view('admin.registers.pdf.pdf', compact('register'));
    }

    public function show($id)
    {
        $register = Register::find($id);
        return view('admin.registers.show', compact('register'));
    }

    public function edit($id)
    {
        $providers = Provider::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $register = Register::find($id);
        return view('admin.registers.edit', compact('register', 'providers', 'products'));
    }

    public function update(RegistersRequest $request, register $register)
    {
        $request = $request->all();
        $request['updated'] = Auth()->user()->id;
      /*  if ($request['type']=='remove') {
            $request['provider_id'] = Auth()->user()->id;
        }*/
        $register->update($request);

        $id=$register->id;
        $q = $request['quantity'];
        $p = $request['product_id'];
        //formating array
        $extra = array_map(function($q){
            return ['quantity' => $q];
        }, $q);
        //combining array
        $data = array_combine($p, $extra);
        //ready to sync
        $register->products()->sync($data);

        // Flash::success('Se ha registrado la orden de manera exitosa!')->important();
        return redirect()->route('confirmregister', $register->id);
    }

    public function destroy($id)
    {
        $register = Register::find($id);
        $register->delete();
       // flash('El registro ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('registers.index');
    }
}

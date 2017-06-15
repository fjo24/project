<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Register;
Use App\Product;
Use App\Provider;
Use App\User;
use Laracasts\Flash\Flash;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
class RegistersController extends Controller
{

    public function index()
    {
        $registers = Register::orderBy('id', 'DESC')->get();
        return view('registers.index', compact('registers'));
    }

    public function create()
    {
        $provider = Provider::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $product = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('registers.create', compact('provider', 'product'));
    }

    public function store(Request $request)
    {           
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
        */
        Flash::success('Se ha registrado de manera exitosa!')->important();
        return redirect()->route('registers.index');
    }

    public function show($id)
    {
        $register = Register::find($id);
        return view('registers.show', compact('register'));
    }

    public function edit($id)
    {
        $provider = Provider::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $product = Product::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $register = Register::find($id);
        return view('registers.edit', compact('register', 'provider', 'product'));
    }

    public function update(Request $request, register $register)
    {
        $request = $request->all();
        $register->update($request);
        flash('El registro se ha sido editado con exito!!', 'success')->important();
        return redirect()->route('registers.index');
    }

    public function destroy($id)
    {
        $register = Register::find($id);
        $register->delete();
        flash('El registro ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('registers.index');
    }
}

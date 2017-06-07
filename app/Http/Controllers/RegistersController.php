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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registers = Register::orderBy('id', 'DESC')->get();
        return view('registers.index', compact('registers'));
    }

    public function create()
    {
        $provider = Provider::orderBy('name', 'ASC')->lists('name');
        dd('$provider');
        $product = Product::orderBy('name', 'ASC')->lists('name');
        return view('registers.create', compact('provider', 'product'));
    }

    public function store(Request $request)
    {
        $request = $request->all();
        $register = new Register($request);
        $register->save();
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
        $provider = Provider::orderBy('name', 'ASC')->lists('name', 'provider_id');
        $product = Product::orderBy('name', 'ASC')->lists('name', 'product_id');
        $register = Register::find($id);
        return view('registers.edit', compact('register', 'provider', 'product'));
    }

    public function update(Request $request, $id)
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

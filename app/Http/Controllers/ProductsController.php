<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Product;
use Laracasts\Flash\Flash;
use App\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('name', 'DESC')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request = $request->all();
        $product = new Product($request);
        $product->save();
        Flash::success('Se ha registrado el producto '. $product->name. ' de manera exitosa!')->important();
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, product $product)
    {
        $request = $request->all();
        $product->update($request);
        flash('El producto '. $product->name. ' ha sido editado con exito!!', 'success')->important();
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        flash('El producto '. $product->name.' ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('products.index');
    }
}
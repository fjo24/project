<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Provider;
use Laracasts\Flash\Flash;
use App\Http\Requests\ProviderRequest;

class ProvidersController extends Controller
{

    public function index()
    {
        $providers = Provider::orderBy('name', 'DESC')->get();
        return view('admin.providers.index', compact('providers'));
    }

    public function create()
    {
        return view('admin.providers.create');
    }

    public function store(ProviderRequest $request)
    {
        $request = $request->all();
        $provider = new Provider($request);
        $provider->save();
       // Flash::success('Se ha registrado el proveedor '. $provider->title. ' de manera exitosa!')->important();
        return redirect()->route('providers.index');
    }

    public function show($id)
    {
        $provider = Provider::find($id);
        return view('admin.providers.show', compact('provider'));
    }

    public function edit($id)
    {
        $provider = Provider::find($id);
        return view('admin.providers.edit', compact('provider'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'           => 'max:30',     
            'email'          => 'email|required|unique:providers,email, '. $id, 
            'rif'            => 'required|max:15|unique:providers,rif, '. $id,
            'locale'         => 'required|max:130',
        ]);
        $request = $request->all();
        $provider = Provider::find($id);
        $provider->update($request);
     //   flash('El proveedor '. $provider->name. ' ha sido editado con exito!!', 'success')->important();
        return redirect()->route('providers.index');
    }

    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();
        //flash('El proveedor '. $provider->name.' ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('providers.index');
    }
}

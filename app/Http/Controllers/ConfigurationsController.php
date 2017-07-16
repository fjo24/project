<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Configuration;
use Laracasts\Flash\Flash;

class ConfigurationsController extends Controller
{
	public function edit($id)
    {

        $config = Configuration::find(1);
        return view('admin.configurations.edit', compact('config'));
    }

    public function update(Request $request)
    {

    	$this->validate($request, [
            'iva'           => 'required',
        ]);

        $config = Configuration::find(1);
        $config->fill($request->all());
        $config->save();

        Flash::success('Se ha configurado de manera exitosa!')->important();
        return view('/home');
    }
}

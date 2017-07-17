<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Event;
use Laracasts\Flash\Flash;
class EventController extends Controller
{

    public function index()
    {
        $events = Event::orderBy('name', 'DESC')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        if (Auth()->user()->level=='admin') {
            return view('admin.events.create');
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        }
        
    }

    public function store(Request $request)
    {
        $request = $request->all();
        $event = new Event($request);
        $event->save();
       // Flash::success('Se ha registrado el proveedor '. $provider->title. ' de manera exitosa!')->important();
        return redirect()->route('events.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $event = Event::find($id);
        if (Auth()->user()->level=='admin') {
            return view('admin.events.edit', compact('event'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        }
        
    }

    public function update(Request $request, $id)
    {
        $request = $request->all();
        $event = Event::find($id);
        $event->update($request);
     //   flash('El proveedor '. $event->name. ' ha sido editado con exito!!', 'success')->important();
        return redirect()->route('events.index');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        //flash('El proveedor '. $event->name.' ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('events.index');
    }
}

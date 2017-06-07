<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
use Laracasts\Flash\Flash;
use Validator;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\EditUsersRequest;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
class UsersController extends Controller
{

    public function index()
    {
        $users = User::orderBy('name', 'DESC')->get();
        return view('users.index', compact('users', $users));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UsersRequest $request)
    {
        $request = $request->all();
        $user = new User($request);
        $user->password = bcrypt($request['password']);
        $user->save();
        Flash::success('Se ha registrado el usuario '. $user->name. ' '. $user->last_name.' de manera exitosa!')->important();
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(EditUsersRequest $request, $id)
    {   
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        flash('El usuario '. $user->name. ' '. $user->last_name.' ha sido editado con exito!!', 'success')->important();
        return redirect()->route('users.index');
    }

    public function export(Request $request, User $users)
    {
       Excel::create('Listado de usuarios', function($excel) {
            $excel->sheet('listado', function($sheet) {
                 $users = User::orderBy('name', 'ASC')->get();
                $sheet->loadView('users.excel.export')->with('users', $users);
            });
        })->export('xls');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        flash('El usuario '. $user->name. ' '. $user->last_name.' ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('users.index');
    }
}

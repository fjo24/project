<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Photo;
use Laracasts\Flash\Flash;
use Validator;
use App\Http\Requests\PersonRequest;
use App\Http\Requests\EditPersonRequest;
use App\Http\Requests\OrganizationRequest;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\EditUsersRequest;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class UsersController extends Controller
{

    public function member()
    {
        return view('member.users.member');
    }

    //select type of user [person or organization]

    public function type()
    {
        return view('member.users.type');
    }

    // create user type person

    public function newperson()
    {
        return view('member.users.person.newperson');
    }

    public function storeperson(PersonRequest $request)
    {

        $user = User::create([
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'fullname' => $request['name'] . " " . $request['lastname'],
            'type' => 'person',
            'identification' => $request['identification'],
            'telephone' => $request['telephone'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        $user->save();


        Flash::success('Se ha registrado de manera exitosa. Ya '. $user->fullname.' puede iniciar sesión!')->important();
        return view('/home');
    }

    public function editperson($id)
    {
        $user = User::find($id);
        if (Auth()->user()->id==$id) {
        return view('member.users.person.editperson', compact('user'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        }
        
    }

    public function updateperson(Request $request, $id)
    {
        $this->validate($request, [
            'email'          => 'email|required|unique:users,email, '. $id,
            'identification' => 'required|unique:users,identification, '. $id,
            'name'           => 'max:50|required',   
            'lastname'       => 'max:50|required',   
            'telephone'      => 'required|numeric|min:10',
            'password'       => 'required|confirmed|min:6', 
        ]);
        $request['fullname'] = $request['name'] . " " . $request['lastname'];
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        flash('El usuario '. $user->fullname.' ha sido editado con exito!!', 'success')->important();
        return view('/home');
    }
    //create user type organization

    public function neworganization()
    {
        return view('member.users.organization.neworganization');
    }

    public function storeorganization(OrganizationRequest $request)
    {
        $request = $request->all();
        $request['type'] = 'organization';
        $user = new User($request);
        $user->password = bcrypt($request['password']);
        $user->save();

        Flash::success('Se ha registrado de manera exitosa. Ya '. $user->fullname.' puede iniciar sesión!')->important();
        return view('/home');
    }

    public function editorganization($id)
    {
        $user = User::find($id);
        if (Auth()->user()->id==$id) {
        return view('member.users.organization.editorganization', compact('user'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        }
        
    }

    public function updateorganization(Request $request, $id)
    {
        $this->validate($request, [
            'email'          => 'email|required|unique:users,email, '. $id,
            'identification' => 'required|unique:users,identification, '. $id, 
            'fullname'       => 'max:80|required',   
            'telephone'      => 'required|numeric|min:10',
            'password'       => 'required|confirmed|min:6', 
        ]);
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        flash('El usuario '. $user->fullname.' ha sido editado con exito!!', 'success')->important();
        return view('/home');
    }

    //show user type member

    public function showmember($id)
    {
        $user = User::find($id);
        return view('member.users.show', compact('user'));
    }

    public function index()
    {
        $users = User::orderBy('fullname', 'DESC')->get();
        if (Auth()->user()->level=='admin') {
        return view('admin.users.index', compact('users', $users));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        }
    }

    public function create()
    {
        if (Auth()->user()->level=='admin') {
        return view('admin.users.create');
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        }
        
    }

    public function store(UsersRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'fullname' => $request['name'] . " " . $request['lastname'],
            'type' => 'person',
            'identification' => $request['identification'],
            'telephone' => $request['telephone'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        $user->save();
        $date = $request->get('date');
        //Flash::success('Se ha registrado el usuario '. $user->name. ' '. $user->last_name.' de manera exitosa!')->important();
        
        return view('admin.orders.select_client')->with('date', $date)->with('success', 'Se ha registrado de manera exitosa!');

    }

    public function show($id)
    {
        $user = User::find($id);
        if (Auth()->user()->level=='admin') {
        return view('admin.users.show', compact('user'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        }
        
    }

    public function edit($id)
    {

        $user = User::find($id);
        if (Auth()->user()->level=='admin') {
return view('admin.users.edit', compact('user'));
        }else{
            Flash::success('ACCESO NO AUTORIZADO!!!')->important();
            return view('/home');
        }
        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email, '. $id,
            'identification' => 'required|unique:users,identification, '. $id,   
            'telephone'      => 'required|numeric|min:11',
            'type'           => 'required',
        ]);
        $request['fullname'] = $request['name'] . " " . $request['lastname'];
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        //flash('El usuario '. $user->fullname.' ha sido editado con exito!!', 'success')->important();
        return redirect()->route('users.index');
    }

    public function export(Request $request, User $users)
    {
        Excel::create('Listado de usuarios', function($excel) {
            $excel->sheet('listado', function($sheet) {
                $users = User::orderBy('name', 'ASC')->get();
                $sheet->loadView('admin.users.excel.export')->with('users', $users);
            });
        })->export('xls');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        //flash('El usuario '. $user->name. ' '. $user->last_name.' ha sido eliminado con exito!!', 'danger')->important();
        return redirect()->route('users.index');
    }
}

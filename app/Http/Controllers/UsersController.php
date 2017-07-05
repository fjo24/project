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
        $request = $request->all();
        

 /*       if ($request->file('photo'))
        {
        $file = $request->file('photo'); //recibe la imagen en la variable $file
        $name = 'francachela' . time() . '.' . $file->getClientOriginalExtension(); //asignamos nombre, agregamos el time() para que de un numero unico (tiempo)-> ya que cada segundo cambia
        $path = public_path() .'/images/users/';//public_path es la direccion, se la asignamos a la variable $path, y si queremos en una carpeta diferente, terminamos de agregar el directorio (hay que crear carpetas)
        $file->move($path, $name);//aqui tomamos la imagen que esta ya en la variable $file y la guardamos en el direcctorio creado y asignado a la variable $path, con el nombre ya creado y unico. (primer parametro es la direccion(path) y segundo parametro es el nombre que se le dara)
        }
*/      
        /*$img=$request->file('avatar');
        $file_route = time().'_'.$img->getClientOriginalName();
        Storage::disk('imgUsers')->put($file_route, file_get_contents( $img->getRealPath() ) );
*/
        $request['fullname'] = $request['name'] . " " . $request['lastname'];
        $request['type'] = 'person';
        $user = new User($request);
      //  $user->avatar = $file_route;
        $user->password = bcrypt($request['password']);
        $user->save();

        //Flash::success('Se ha registrado el usuario '. $user->name. ' '. $user->last_name.' de manera exitosa!')->important();
        return view('member.users.member');
    }

    public function editperson($id)
    {
        $user = User::find($id);
        return view('member.users.person.editperson', compact('user'));
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
        //flash('El usuario '. $user->fullname.' ha sido editado con exito!!', 'success')->important();
        return view('member.users.member');
    }
    //create user type organization

    public function neworganization()
    {
        return view('member.users.organization.neworganization');
    }

    public function storeorganization(OrganizationRequest $request)
    {
        $request = $request->all();

       /* if ($request->file('photo'))
        {
        $file = $request->file('photo'); //recibe la imagen en la variable $file
        $name = 'francachela' . time() . '.' . $file->getClientOriginalExtension(); //asignamos nombre, agregamos el time() para que de un numero unico (tiempo)-> ya que cada segundo cambia
        $path = public_path() .'/images/users/';//public_path es la direccion, se la asignamos a la variable $path, y si queremos en una carpeta diferente, terminamos de agregar el directorio (hay que crear carpetas)
        $file->move($path, $name);//aqui tomamos la imagen que esta ya en la variable $file y la guardamos en el direcctorio creado y asignado a la variable $path, con el nombre ya creado y unico. (primer parametro es la direccion(path) y segundo parametro es el nombre que se le dara)
        }*/

        $request['type'] = 'organization';
        $user = new User($request);
        $user->password = bcrypt($request['password']);
        $user->save();
/*
        $image = new Photo();
        $image->name = $name;
        $image->user()->associate($user);//aqui estamos llamando al metodo que esta en el modelo image llamado article, y le aplicamos la funcion llamada associate... que lo que hace es tomar lo que lo asocia (en este caso el article_id)
        $image->save();*/

        return view('member.users.member');
    }

    public function editorganization($id)
    {
        $user = User::find($id);
        return view('member.users.organization.editorganization', compact('user'));
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
        //flash('El usuario '. $user->fullname.' ha sido editado con exito!!', 'success')->important();
        return view('member.users.member');
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
        return view('admin.users.index', compact('users', $users));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UsersRequest $request)
    {
        $request = $request->all();

        
        $user = new User($request);
        $user->password = bcrypt($request['password']);
        $user->save();
        //Flash::success('Se ha registrado el usuario '. $user->name. ' '. $user->last_name.' de manera exitosa!')->important();
        
        return redirect()->route('select-client', $user)->with('success', 'Se ha registrado de manera exitosa!');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
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

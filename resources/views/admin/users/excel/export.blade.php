<table class="table table-hover display table-responsive table-condensed" id="table">
                            <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>TIPO</th>
                                <th>NUMERO DE DOCUMENTO</th>
                                <th>TELEFONO</th>
                                <th>CORREO ELECTRONICO</th>
                                <th>MIEMBRO DESDE</th>
                                <th>NIVEL DE USUARIO</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->fullname }} 
                                    </td>
                                    <td>
                                        @if($user->type == "person")
                                            Persona natural
                                        @else
                                            Organización
                                        @endif
                                    </td>
                                    <td>
                                        {{ $user->identification }}
                                    </td>
                                    <td>
                                        {{ $user->telephone }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->created_at }}
                                    </td>
                                    <td>
                                        @if($user->level == "admin")
                                            <span class="label label-danger">
                                        Admin
                                    </span>
                                        @else
                                            <span class="label label-primary">
                                        Miembro
                                    </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if($user->type == "person")
                                            <a href="{{ route('editperson', $user->id) }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('editorganization', $user->id) }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                                        <button class="glyphicon glyphicon-remove" onclick="return confirm('¿Realmente deseas borrar el usuario?')"">
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
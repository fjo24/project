<table>
     <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>CEDULA</th>
                                <th>TELEFONO</th>
                                <th>CORREO ELECTRONICO</th>
                                <th>MIEMBRO DESDE</th>
                                <th>TIPO</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                       {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->last_name }}
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
                                    @if($user->type == "admin")
                                    
                                        Administrador
                                
                                    @else
                      
                                        Miembro
                        
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
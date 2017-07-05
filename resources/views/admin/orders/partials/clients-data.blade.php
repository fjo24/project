<!-- left column -->
<div class="col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Datos del cliente</h3>
                <a href="{{ route('users.edit', $user->id) }}" class="pull-right" onclick="return confirm('Se perderan los datos introducidos ¿Desea continuar?')"">Editar</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <div class="form-group">
                    <label for="inputtype3" class="col-md-4 control-label">Tipo</label>
                    <div class="col-sm-8">
                    <input type="type" class="form-control"
                           placeholder="{{$user->type }}" disabled>
                    </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Nombre</label>

                <div class="col-sm-8">
                    <input type="hidden" value="{{$user->id}}" name="user_id" id="user_id">
                    <input type="email" class="form-control"
                           placeholder="{{$user->fullname}}" disabled>
                </div>

            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">Cedula o rif</label>

                <div class="col-sm-8">
                    <input type="password" class="form-control"
                           placeholder="{{$user->identification}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">Telefono</label>

                <div class="col-sm-8">
                    <input type="password" class="form-control"
                           placeholder="{{$user->telephone}}" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">Email</label>

                <div class="col-sm-8">
                    <input type="password" class="form-control"
                           placeholder="{{$user->email}}" disabled>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer -->
    </div>
</div>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(count($errors) > 0)
    <div class="alert alert-danger" role "alert">
    <ul>
        @foreach($errors-> all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif
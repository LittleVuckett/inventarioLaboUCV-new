@extends('layouts.dashboard')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-users"></i></div>
                        Usuarios
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('users.create') }}" class="btn btn-primary add-list"><i class="fa-solid fa-plus me-3"></i>Add</a>
                    <a href="{{ route('users.index') }}" class="btn btn-danger add-list"><i class="fa-solid fa-trash me-3"></i>Clear Search</a>
                </div>
            </div>

            @include('partials._breadcrumbs', ['model' => $users])
        </div>
    </div>

    @include('partials.session')
</header>

<div class="container px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mx-n4">
                <div class="col-lg-12 card-header mt-n4">
                    <form action="{{ route('users.index') }}" method="GET">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="form-group row align-items-center">
				<label for="row" class="col-auto">Fila:</label>
<div class="col-auto">
    <select class="form-control" name="row">
        <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
        <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
        <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
        <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
    </select>
</div>
</div>

<div class="form-group row align-items-center justify-content-between">
    <label class="control-label col-sm-3" for="search">Buscar:</label>
    <div class="col-sm-8">
        <div class="input-group">
            <input type="text" id="search" class="form-control me-1" name="search" placeholder="Buscar usuario" value="{{ request('search') }}">
            <div class="input-group-append">
                <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20 text-white"></i></button>
            </div>
        </div>
    </div>
</div>
</div>
</form>
</div>

<hr>

<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">@sortablelink('name', 'Nombre')</th>
                    <th scope="col">@sortablelink('username', 'Usuario')</th>
                    <th scope="col">@sortablelink('email', 'Correo')</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ (($users->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('users.edit', $user->username) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('users.destroy', $user->username) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este registro?')">
                                    <i class="far fa-trash-alt"></i>

                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection

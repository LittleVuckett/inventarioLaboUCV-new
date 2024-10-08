@extends('layouts.dashboard')

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-folder"></i></div>
                        Listado de Ambientes
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('units.create') }}" class="btn btn-primary add-list"><i class="fa-solid fa-plus me-3"></i>Agregar</a>
                    <a href="{{ route('units.index') }}" class="btn btn-danger add-list"><i class="fa-solid fa-trash me-3"></i>Borrar Búsqueda</a>
                </div>
            </div>

            @include('partials._breadcrumbs')
        </div>
    </div>

    @include('partials.session')
</header>

<!-- BEGIN: Main Page Content -->
<div class="container px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mx-n4">
                <div class="col-lg-12 card-header mt-n4">
                    <form action="{{ route('units.index') }}" method="GET">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="form-group row align-items-center">
                                <label for="row" class="col-auto">Filas:</label>
                                <div class="col-auto">
                                    <label>
                                        <select class="form-control" name="row">
                                            <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                            <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                            <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                            <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row align-items-center justify-content-between">
                                <label class="control-label col-sm-3" for="search">Búsqueda:</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control me-1" name="search" placeholder="Búsqueda de Ambientes" value="{{ request('search') }}">
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
                                    <th scope="col">No.</th>
                                    <th scope="col">@sortablelink('name', 'Nombre')</th>
                                    <th scope="col">@sortablelink('slug', 'Cod')</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $unit)
                                <tr>
                                    <th scope="row">{{ (($units->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>{{ $unit->name }}</td>
                                    <td>{{ $unit->slug }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('units.edit', $unit->slug) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('units.destroy', $unit->slug) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que desea borrar?')">
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

                {{ $units->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection

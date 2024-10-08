@extends('layouts.dashboard')

@push('page-styles')
    {{--- ---}}
@endpush

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto my-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Listado de Elementos
                    </h1>
                </div>
                <div class="col-auto my-4">
                    <a href="{{ route('products.import') }}" class="btn btn-success add-list my-1"><i class="fa-solid fa-file-import me-3"></i>Importar de Excel</a>
                    <a href="{{ route('products.export') }}" class="btn btn-warning add-list my-1"><i class="fa-solid fa-file-arrow-down me-3"></i>Exportar a Excel</a>
                    <a href="{{ route('products.create') }}" class="btn btn-primary add-list my-1"><i class="fa-solid fa-plus me-3"></i>Agregar</a>
                    <a href="{{ route('products.index') }}" class="btn btn-danger add-list my-1"><i class="fa-solid fa-trash me-3"></i>Quitar Búsqueda</a>
                </div>
            </div>

            @include('partials._breadcrumbs')
        </div>
    </div>

    @include('partials.session')
</header>

<div class="container px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mx-n4">
                <div class="col-lg-12 card-header mt-n4">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="form-group row align-items-center">
                                <label for="row" class="col-auto">Cantidad de Filas:</label>
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
                                <label class="control-label col-sm-3" for="search">Búsqueda:</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control me-1" name="search" placeholder="Búscar Elemento" value="{{ request('search') }}">
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
                        <table class="table table-striped align-middle">
                            <thead class="thead-light">
                                <tr>
<th scope="col">No.</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">@sortablelink('product_name', 'Nombre de Elemento')</th>
                            <th scope="col">@sortablelink('category.name', 'Categoría')</th>
                            <th scope="col">@sortablelink('stock', 'Cantidad')</th>
                            <th scope="col">@sortablelink('unit.name', 'Ambiente')</th>
                            <th scope="col">@sortablelink('selling_price', 'Valor Actual')</th>
                           
                            <th scope="col">Número de Serie</th>
                            <th scope="col">Marca</th>
                            <th scope="col">RAM</th>
                            <th scope="col">Capacidad de Almacenamiento</th>
                            <th scope="col">GPU</th>
                            <th scope="col">Obsoleto?</th>

                            <th scope="col">De Baja?</th>
                            <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ (($products->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                    <td>
                                        <div style="max-height: 80px; max-width: 80px;">
                                            <img class="img-fluid"  src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.webp') }}">
                                        </div>
                                    </td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->unit->name }}</td>
                                    <td>{{ $product->selling_price }}</td>
					<td>{{ $product->serial_number }}</td>
                            <td>{{ $product->make_or_brand }}</td>
                            <td>{{ $product->ram }}GB</td>
                            <td>{{ $product->storage_capacity }}GB</td>
                            <td>{{ $product->gpu }}</td>
                            <td>{{ $product->is_obsolete ? 'Sí' : 'No' }}</td>
                            <td>{{ $product->is_written_off ? 'Sí' : 'No' }}</td>
		<td>                           
                                        <div class="d-flex">
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-success btn-sm mx-1"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">
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

                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    {{--- ---}}
@endpush

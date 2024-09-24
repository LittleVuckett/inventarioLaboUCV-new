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
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Detalles
                    </h1>
                </div>
            </div>

            @include('partials._breadcrumbs')
        </div>
    </div>
</header>

<div class="container-xl px-2 mt-n10">
    <div class="row">
        <div class="col-xl-4">
            <!-- Product image card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Imagen de Elemento</div>
                <div class="card-body text-center">
                    <!-- Product image -->
  <img class="img-account-profile mb-2" src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <!-- BEGIN: Product Code -->
            <div class="card mb-4">
                <div class="card-header">
                    Código interno de inventario
                </div>
                <div class="card-body">
                    <!-- Form Row -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (type of product category) -->
                        <div class="col-md-6">
                            <label class="small mb-1">código</label>
                            <div class="form-control form-control-solid">{{ $product->product_code  }}</div>
                        </div>
                        <!-- Form Group (type of product unit) -->
                        <div class="col-md-6 align-middle">
                            <label class="small mb-1">Código de Barras</label>
                            <div class="mt-1">
                              {!! $barcode !!}
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Product Code -->

            <!-- BEGIN: Product Information -->
<div class="card mb-4">
    <div class="card-header">
        Información del Producto
    </div>
    <div class="card-body">
        <!-- Form Group (product name) -->
        <div class="mb-3">
            <label class="small mb-1">Nombre de Elemento</label>
            <div class="form-control form-control-solid">{{ $product->product_name }}</div>
        </div>
        <!-- Form Row -->
        <div class="row gx-3 mb-3">
            <!-- Form Group (product category) -->
            <div class="col-md-6">
                <label class="small mb-1">Categoría</label>
                <div class="form-control form-control-solid">{{ $product->category->name }}</div>
            </div>
            <!-- Form Group (product unit) -->
            <div class="col-md-6">
                <label class="small mb-1">Ambiente</label>
                <div class="form-control form-control-solid">{{ $product->unit->name }}</div>
            </div>
        </div>
        <!-- Form Row -->
        <div class="row gx-3 mb-3">
            <!-- Form Group (buying price) -->
            <div class="col-md-6">
                <label class="small mb-1">Precio de Compra</label>
                <div class="form-control form-control-solid">{{ $product->buying_price }}</div>
            </div>
            <!-- Form Group (selling price) -->
            <div class="col-md-6">
                <label class="small mb-1">Precio de Venta</label>
                <div class="form-control form-control-solid">{{ $product->selling_price }}</div>
            </div>
        </div>
        <!-- Form Group (stock) -->
        <div class="mb-3">
            <label class="small mb-1">Cantidad</label>
            <div class="form-control form-control-solid">{{ $product->stock }}</div>
        </div>
              
<div class="mb-3">
    <label class="small mb-1">Número de Serie</label>
    <div class="form-control form-control-solid">{{ $product->serial_number }}</div>
</div>

<div class="mb-3">
    <label class="small mb-1">Marca</label>
    <div class="form-control form-control-solid">{{ $product->make_or_brand }}</div>
</div>

<div class="mb-3">
    <label class="small mb-1">RAM en Gb</label>
    <div class="form-control form-control-solid">{{ $product->ram }}</div>
</div>

<div class="mb-3">
    <label class="small mb-1">Capacidad de Almacenamiento en Gb</label>
    <div class="form-control form-control-solid">{{ $product->storage_capacity }}</div>
</div>

<div class="mb-3">
    <label class="small mb-1">GPU</label>
    <div class="form-control form-control-solid">{{ $product->gpu }}</div>
</div>

<div class="row gx-3 mb-3">
            <!-- Is Obsolete -->
            <div class="col-md-6">
                <label class="small mb-1">Obsoleto?</label>
                <div class="form-control form-control-solid">{{ $product->is_obsolete ? 'Sí' : 'No' }}</div>
            </div>

            <!-- Is Written Off -->
            <div class="col-md-6">
                <label class="small mb-1">De Baja?</label>
                <div class="form-control form-control-solid">{{ $product->is_written_off ? 'Sí' : 'No' }}</div>
            </div>
        </div>


	<div class="mb-3">
    <label class="small mb-1">Cod. Inventario UCV</label>
    <div class="form-control form-control-solid">{{ $product->codInventarioUCV }}</div>
</div>

        <!-- Observations (Comments) -->
        <div class="mb-3">
            <label class="small mb-1">Observaciones</label>
            <div class="form-control form-control-solid">{{ $product->comments }}</div>
        </div>


      <!-- Submit button -->
                    <a class="btn btn-primary" href="{{ route('products.index') }}">Regresar</a>
                </div>
            </div>
            <!-- END: Product Information -->
        </div>
    </div>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    {{--- ---}}
@endpush

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
                        Agregar Elemento
                    </h1>
                </div>
            </div>

            @include('partials._breadcrumbs')
        </div>
    </div>
</header>

<div class="container-xl px-2 mt-n10">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Imagen de Elemento</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG  menor a  2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('product_image') is-invalid @enderror" type="file"  id="image" name="product_image" accept="image/*" onchange="previewImage();">
                        @error('product_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Detalles del Elemento
                    </div>
                    <div class="card-body">
                        <!-- Form Group (product name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="product_name">Nombre <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('product_name') is-invalid @enderror" id="product_name" name="product_name" type="text" placeholder="" value="{{ old('product_name') }}" autocomplete="off"/>
                            @error('product_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="category_id">Categoría <span class="text-danger">*</span></label>
                                <select class="form-select form-control-solid @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                    <option selected="" disabled="">Seleccione Categoría:</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product unit) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="unit_id">Ambiente <span class="text-danger">*</span></label>
                                <select class="form-select form-control-solid @error('unit_id') is-invalid @enderror" id="unit_id" name="unit_id">
                                    <option selected="" disabled="">Seleccione Ambiente:</option>
                                    @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" @if(old('unit_id') == $unit->id) selected="selected" @endif>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (buying price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="buying_price">Precio de Compra <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('buying_price') is-invalid @enderror" id="buying_price" name="buying_price" type="text" placeholder="" value="{{ old('buying_price') }}" autocomplete="off" />
                                @error('buying_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (selling price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="selling_price">Precio Actual<span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" type="text" placeholder="" value="{{ old('selling_price') }}" autocomplete="off" />
                                @error('selling_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Group (stock) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="stock">Cantidad <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('stock') is-invalid @enderror" id="stock" name="stock" type="text" placeholder="" value="{{ old('stock') }}" autocomplete="off" />
                            @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
			<div class="row gx-3 mb-3">
            <div class="col-md-6">
                <label class="small mb-1" for="serial_number">Serial</label>
                <input class="form-control form-control-solid" id="serial_number" name="serial_number" type="text" placeholder="Serial" value="{{ old('serial_number') }}" />
            </div>
            <div class="col-md-6">
                <label class="small mb-1" for="make_or_brand">Marca</label>
                <input class="form-control form-control-solid" id="make_or_brand" name="make_or_brand" type="text" placeholder="Marca"value= "{{ old('make_or_brand') }}" />
            </div>
        </div>

        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                <label class="small mb-1" for="ram">RAM (GB)</label>
                <input class="form-control form-control-solid" id="ram" name="ram" type="number" placeholder="RAM en GB" value="{{ old('ram') }}" />
            </div>
            <div class="col-md-6">
                <label class="small mb-1" for="storage_capacity">Capacidad de almacenamiento(GB)</label>
                <input class="form-control form-control-solid" id="storage_capacity" name="storage_capacity" type="number" placeholder="Capacidad en GB" value="{{ old('storage_capacity') }}" />
            </div>
        </div>

        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                <label class="small mb-1" for="gpu">GPU</label>
                <input class="form-control form-control-solid" id="gpu" name="gpu" type="text" placeholder="GPU" value="{{ old('gpu') }}" />
            </div>
            <div class="col-md-6">
                <label class="small mb-1" for="is_obsolete">Obsoleto?</label>
                <select class="form-select form-control-solid" id="is_obsolete" name="is_obsolete">
                    <option value="0" {{ old('is_obsolete') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('is_obsolete') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
        </div>

<div class="row gx-3 mb-3">
    <div class="col-md-6">
        <label class="small mb-1" for="is_written_off">De Baja?</label>
        <select class="form-select form-control-solid" id="is_written_off" name="is_written_off">
            <option value="0" {{ old('is_written_off') == '0' ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('is_written_off') == '1' ? 'selected' : '' }}>Yes</option>
        </select>
    </div>

    {{-- New field for codInventarioUCV --}}
    <div class="col-md-6">
        <label class="small mb-1" for="codInventarioUCV">Inventario UCV</label>
        <input type="text" class="form-control form-control-solid" id="codInventarioUCV" name="codInventarioUCV" placeholder="Inventario UCV" value="{{ old('codInventarioUCV') }}">
    </div>
</div>

<div class="row gx-3 mb-3">
    <div class="col-md-12">
        <label class="small mb-1" for="comments">Observaciones</label>
        <textarea class="form-control form-control-solid" id="comments" name="comments" rows="4" placeholder="Observaciones">{{ old('comments') }}</textarea>
    </div>
</div>
                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Crear</button>
                        <a class="btn btn-danger" href="{{ route('products.index') }}">Cancelar</a>
                    </div>
                </div>
                <!-- END: Product Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->
@endsection

@push('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpush

@extends('layouts.dashboard')

@push('page-styles')

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
                        Editar Elemento
                    </h1>
                </div>
            </div>

            @include('partials._breadcrumbs')
        </div>
    </div>
</header>

<div class="container-xl px-2 mt-n10">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Imagen de Elemento</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img class="img-account-profile mb-2" src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">JPG o PNG no mas de  2 MB</div>
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
                            <label class="small mb-1" for="product_name">Nombre de Elemento <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('product_name') is-invalid @enderror" id="product_name" name="product_name" type="text" placeholder="" value="{{ old('product_name', $product->product_name) }}" autocomplete="off"/>
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
                                <label class="small mb-1" for="category_id">Categoría<span class="text-danger">*</span></label>
                                <select class="form-select form-control-solid @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                    <option selected="" disabled="">Seleccione Categoría:</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category_id', $product->category_id) == $category->id) selected="selected" @endif>{{ $category->name }}</option>
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
                                    <option selected="" disabled="">Selelecione Ambiente:</option>
                                    @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" @if(old('unit_id', $product->unit_id) == $unit->id) selected="selected" @endif>{{ $unit->name }}</option>
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
                                <input class="form-control form-control-solid @error('buying_price') is-invalid @enderror" id="buying_price" name="buying_price" type="text" placeholder="" value="{{ old('buying_price', $product->buying_price) }}" autocomplete="off" />
                                @error('buying_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (selling price) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="selling_price">Precio Actual <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" type="text" placeholder="" value="{{ old('selling_price', $product->selling_price) }}" autocomplete="off" />
                                @error('selling_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Group (stock) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="stock">Cantidad (solo si es elemento no serializado) <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('stock') is-invalid @enderror" id="stock" name="stock" type="text" placeholder="" value="{{ old('stock', $product->stock) }}" autocomplete="off" />
                            @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


			<div class="row gx-3 mb-3">
    <!-- Serial Number -->
    <div class="col-md-6">
        <label class="small mb-1" for="serial_number">Número de Serie</label>
        <input class="form-control form-control-solid @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" type="text" placeholder="Número de Serie" value="{{ old('serial_number', $product->serial_number) }}">
        @error('serial_number')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Make or Brand -->
    <div class="col-md-6">
        <label class="small mb-1" for="make_or_brand">Marca</label>
        <input class="form-control form-control-solid @error('make_or_brand') is-invalid @enderror" id="make_or_brand" name="make_or_brand" type="text" placeholder="Marca" value="{{ old('make_or_brand', $product->make_or_brand) }}">
        @error('make_or_brand')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="row gx-3 mb-3">
    <!-- RAM -->
    <div class="col-md-6">
        <label class="small mb-1" for="ram">RAM</label>
        <input class="form-control form-control-solid @error('ram') is-invalid @enderror" id="ram" name="ram" type="text" placeholder="RAM" value="{{ old('ram', $product->ram) }}">
        @error('ram')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Storage Capacity -->
    <div class="col-md-6">
        <label class="small mb-1" for="storage_capacity">Capacidad de Almacenamiento</label>
        <input class="form-control form-control-solid @error('storage_capacity') is-invalid @enderror" id="storage_capacity" name="storage_capacity" type="text" placeholder="Capacidad de Almacenamiento" value="{{ old('storage_capacity', $product->storage_capacity) }}">
        @error('storage_capacity')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
<div class="row gx-3 mb-3">
    <!-- GPU -->
    <div class="col-md-6">
        <label class="small mb-1" for="gpu">GPU</label>
        <input class="form-control form-control-solid @error('gpu') is-invalid @enderror" id="gpu" name="gpu" type="text" placeholder="GPU" value="{{ old('gpu', $product->gpu) }}">
        @error('gpu')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Is Obsolete -->
    <div class="col-md-6">
        <label class="small mb-1" for="is_obsolete">Obsoleto?</label>
        <select class="form-select form-control-solid @error('is_obsolete') is-invalid @enderror" id="is_obsolete" name="is_obsolete">
            <option value="0" {{ old('is_obsolete', $product->is_obsolete) == '0' ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('is_obsolete', $product->is_obsolete) == '1' ? 'selected' : '' }}>Yes</option>
        </select>
        @error('is_obsolete')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

<div class="row gx-3 mb-3">
    <!-- Is Written Off -->
    <div class="col-md-6">
        <label class="small mb-1" for="is_written_off">De Baja?</label>
        <select class="form-select form-control-solid @error('is_written_off') is-invalid @enderror" id="is_written_off" name="is_written_off">
            <option value="0" {{ old('is_written_off', $product->is_written_off) == '0' ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('is_written_off', $product->is_written_off) == '1' ? 'selected' : '' }}>Yes</option>
        </select>
        @error('is_written_off')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- CodInventarioUCV -->
    <div class="col-md-6">
        <label class="small mb-1" for="codInventarioUCV">Cod. Inventario UCV</label>
        <input class="form-control form-control-solid @error('codInventarioUCV') is-invalid @enderror" id="codInventarioUCV" name="codInventarioUCV" type="text" placeholder="Cod. Inventario UCV" value="{{ old('codInventarioUCV', $product->codInventarioUCV) }}">
        @error('codInventarioUCV')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>


<div class="row gx-3 mb-3">
    <div class="col-md-12">
        <label class="small mb-1" for="comments">Observaciones</label>
        <textarea class="form-control form-control-solid @error('comments') is-invalid @enderror" id="comments" name="comments" rows="4" placeholder="Observaciones">{{ old('comments', $product->comments) }}</textarea>
        @error('comments')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Editar</button>
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

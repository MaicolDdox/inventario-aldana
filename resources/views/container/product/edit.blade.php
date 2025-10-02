@extends('dashboard')

@section('content')
<div data-theme="light" class="p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Producto</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-error shadow-lg mb-6 text-black">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div>
            <label for="nombre" class="label text-gray-800 font-semibold">Nombre</label>
            <input 
                type="text" 
                name="nombre" 
                id="nombre" 
                value="{{ old('nombre', $product->nombre) }}" 
                class="input input-bordered w-full text-black" 
                required>
        </div>

        {{-- Estado --}}
        <div>
            <label for="estado" class="label text-gray-800 font-semibold">Estado</label>
            <select 
                name="estado" 
                id="estado" 
                class="select select-bordered w-full text-black" 
                required>
                <option value="disponible" {{ $product->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="agotado" {{ $product->estado == 'agotado' ? 'selected' : '' }}>Agotado</option>
            </select>
        </div>

        {{-- Stock --}}
        <div>
            <label for="stock" class="label text-gray-800 font-semibold">Stock</label>
            <input 
                type="number" 
                name="stock" 
                id="stock" 
                value="{{ old('stock', $product->stock) }}" 
                class="input input-bordered w-full text-black" 
                min="0" 
                required>
        </div>

        {{-- Imagen actual --}}
        @if($product->url_img)
            <div>
                <label class="label text-gray-800 font-semibold">Imagen actual</label>
                <img src="{{ asset('storage/' . $product->url_img) }}" 
                     alt="{{ $product->nombre }}" 
                     class="w-40 h-40 object-cover rounded-lg border">
            </div>
        @endif

        {{-- Subir nueva imagen --}}
        <div>
            <label for="url_img" class="label text-gray-800 font-semibold">Cambiar imagen</label>
            <input 
                type="file" 
                name="url_img" 
                id="url_img" 
                class="file-input file-input-bordered w-full text-black">
        </div>

        {{-- Botón --}}
        <div class="flex gap-4">
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
            <a href="{{ route('products.index') }}" class="btn btn-ghost text-black">Cancelar</a>
        </div>
    </form>
</div>
@endsection

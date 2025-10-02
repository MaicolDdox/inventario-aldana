@extends('dashboard')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-900">Editar Herramienta</h1>

    <form action="{{ route('tools.update', $tool) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div>
            <label class="block text-sm font-medium text-gray-900 mb-1">Nombre</label>
            <input type="text" name="nombre" 
                value="{{ old('nombre', $tool->nombre) }}"
                class="input input-bordered w-full text-gray-900 bg-white"
                required>
        </div>

        <!-- Stock -->
        <div>
            <label class="block text-sm font-medium text-gray-900 mb-1">Stock</label>
            <input type="number" name="stock" 
                value="{{ old('stock', $tool->stock) }}"
                class="input input-bordered w-full text-gray-900 bg-white"
                required>
        </div>

        <!-- Estado -->
        <div>
            <label class="block text-sm font-medium text-gray-900 mb-1">Estado</label>
            <select name="estado" class="select select-bordered w-full text-gray-900 bg-white">
                <option value="disponible" {{ $tool->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="agotado" {{ $tool->estado == 'agotado' ? 'selected' : '' }}>Agotado</option>
            </select>
        </div>

        <!-- Imagen actual -->
        <div>
            <label class="block text-sm font-medium text-gray-900 mb-1">Imagen actual</label>
            <div class="mb-2">
                <img src="{{ asset('storage/'.$tool->url_img) }}" 
                     alt="Imagen actual" 
                     class="w-32 h-32 object-cover rounded-md border">
            </div>
        </div>

        <!-- Subir nueva imagen -->
        <div>
            <label class="block text-sm font-medium text-gray-900 mb-1">Cambiar imagen</label>
            <input type="file" name="imagen" accept="image/*" 
                class="file-input file-input-bordered w-full text-gray-900 bg-white">
        </div>

        <!-- Botones -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('tools.index') }}" 
               class="btn btn-outline btn-error">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>
@endsection


@extends('dashboard')

@section('content')
<div data-theme="light" class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Registrar Nuevo Producto</h1>

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-error text-black mb-4">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li class="text-black">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario --}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Nombre --}}
        <div>
            <label for="nombre" class="block font-semibold mb-1 text-black">Nombre</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre') }}"
                class="input input-bordered w-full text-black bg-white"
                required
            >
        </div>

        {{-- Estado (enum: disponible, agotado) --}}
        <div>
            <label for="estado" class="block font-semibold mb-1 text-black">Estado</label>
            <select id="estado" name="estado" class="select select-bordered w-full text-black bg-white">
                <option value="disponible" {{ old('estado', 'disponible') === 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="agotado" {{ old('estado') === 'agotado' ? 'selected' : '' }}>Agotado</option>
            </select>
        </div>

        {{-- Imagen (url_img en la BD) --}}
        <div>
            <label for="url_img" class="block font-semibold mb-1 text-black">Imagen del Producto</label>
            <input
                type="file"
                id="url_img"
                name="url_img"
                accept="image/*"
                class="file-input file-input-bordered w-full text-black bg-white"
                required
            >
            {{-- preview opcional --}}
            <img id="previewImg" src="" alt="" class="mt-3 hidden w-40 h-40 object-cover rounded" />
        </div>

        {{-- Stock --}}
        <div>
            <label for="stock" class="block font-semibold mb-1 text-black">Cantidad (stock)</label>
            <input
                type="number"
                id="stock"
                name="stock"
                value="{{ old('stock', 0) }}"
                min="0"
                class="input input-bordered w-full text-black bg-white"
                required
            >
        </div>

        {{-- Botones --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('products.index') }}" class="btn btn-outline btn-error">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </div>
    </form>
</div>

{{-- Script pequeño para previsualizar la imagen seleccionada --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('url_img');
    const preview = document.getElementById('previewImg');

    if (!fileInput) return;

    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) {
            preview.src = '';
            preview.classList.add('hidden');
            return;
        }
        const url = URL.createObjectURL(file);
        preview.src = url;
        preview.classList.remove('hidden');
    });
});
</script>
@endsection

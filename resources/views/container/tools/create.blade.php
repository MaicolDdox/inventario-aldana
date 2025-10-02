@extends('dashboard')
@section('content')
<div data-theme="light" class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Nueva Herramienta</h1>

    <!-- Mensajes de error -->
    @if ($errors->any())
        <div class="alert alert-error mb-4">
            <ul class="list-disc pl-5 text-sm text-white">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario -->
    <form action="{{ route('tools.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Nombre -->
        <div class="form-control">
            <label class="label">
                <span class="label-text text-gray-700">Nombre</span>
            </label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required 
                   placeholder="Ej: Martillo"
                   class="input input-bordered w-full focus:input-primary">
        </div>

        <!-- Estado -->
        <div class="form-control">
            <label class="label">
                <span class="label-text text-gray-700">Estado</span>
            </label>
            <select name="estado" class="select select-bordered w-full focus:select-primary">
                <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="agotado" {{ old('estado') == 'agotado' ? 'selected' : '' }}>Agotado</option>
            </select>
        </div>

        <!-- Imagen -->
        <div class="form-control">
            <label class="label">
                <span class="label-text text-gray-700">Imagen</span>
            </label>
            <input type="file" name="url_img" accept="image/*" required
                   class="file-input file-input-bordered w-full focus:file-input-primary">
        </div>

        <!-- Stock -->
        <div class="form-control">
            <label class="label">
                <span class="label-text text-gray-700">Stock</span>
            </label>
            <input type="number" name="stock" value="{{ old('stock') }}" min="0" required
                   placeholder="Cantidad disponible"
                   class="input input-bordered w-full focus:input-primary">
        </div>

        <!-- Botones -->
        <div class="form-control mt-6 flex gap-3">
            <button type="submit" class="btn btn-primary w-full">Guardar</button>
            <a href="{{ route('tools.index') }}" class="btn btn-outline w-full">Cancelar</a>
        </div>
    </form>
</div>
@endsection
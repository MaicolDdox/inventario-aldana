@extends('dashboard')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <!-- Breadcrumb -->
    <div class="text-sm breadcrumbs mb-6">
        <ul class="text-gray-600">
            <li><a href="{{ route('tools.index') }}" class="text-green-600 hover:text-green-700">Herramientas</a></li>
            <li class="text-gray-900">Editar Herramienta</li>
        </ul>
    </div>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Editar Herramienta</h1>
        <p class="text-gray-600">Actualiza la información de la herramienta en el inventario</p>
    </div>

    <!-- Errores de validación -->
    @if ($errors->any())
        <div class="alert alert-error mb-6 bg-red-50 border border-red-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h3 class="font-bold text-red-800">Error en el formulario</h3>
                <ul class="text-sm text-red-700 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('tools.update', $tool) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-gray-900 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Nombre de la Herramienta
                    </span>
                </label>
                <input 
                    type="text" 
                    name="nombre" 
                    value="{{ old('nombre', $tool->nombre) }}"
                    class="input input-bordered w-full text-gray-900 bg-white focus:border-green-500 focus:ring-2 focus:ring-green-200"
                    placeholder="Ej: Pala, Rastrillo, Azadón"
                    required>
                <label class="label">
                    <span class="label-text-alt text-gray-600">Ingresa un nombre descriptivo para la herramienta</span>
                </label>
            </div>

            <!-- Stock -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-gray-900 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Cantidad en Stock
                    </span>
                </label>
                <input 
                    type="number" 
                    name="stock" 
                    value="{{ old('stock', $tool->stock) }}"
                    class="input input-bordered w-full text-gray-900 bg-white focus:border-green-500 focus:ring-2 focus:ring-green-200"
                    min="0"
                    placeholder="0"
                    required>
                <label class="label">
                    <span class="label-text-alt text-gray-600">Cantidad disponible en el inventario</span>
                </label>
            </div>

            <!-- Estado -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-gray-900 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Estado
                    </span>
                </label>
                <select 
                    name="estado" 
                    class="select select-bordered w-full text-gray-900 bg-white focus:border-green-500 focus:ring-2 focus:ring-green-200">
                    <option value="disponible" {{ $tool->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="agotado" {{ $tool->estado == 'agotado' ? 'selected' : '' }}>Agotado</option>
                </select>
                <label class="label">
                    <span class="label-text-alt text-gray-600">Estado actual de disponibilidad</span>
                </label>
            </div>

            <!-- Imagen actual -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-gray-900 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Imagen Actual
                    </span>
                </label>
                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <img 
                        src="{{ asset('storage/'.$tool->url_img) }}" 
                        alt="Imagen actual de {{ $tool->nombre }}" 
                        id="currentImage"
                        class="w-32 h-32 object-cover rounded-lg border-2 border-gray-300 shadow-sm">
                    <div class="text-gray-700">
                        <p class="font-medium text-gray-900">Imagen registrada</p>
                        <p class="text-sm text-gray-600 mt-1">Esta es la imagen actual de la herramienta</p>
                    </div>
                </div>
            </div>

            <!-- Subir nueva imagen -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-gray-900 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        Cambiar Imagen (Opcional)
                    </span>
                </label>
                <input 
                    type="file" 
                    name="imagen" 
                    accept="image/*" 
                    id="imageInput"
                    class="file-input file-input-bordered w-full text-gray-900 bg-white focus:border-green-500">
                <label class="label">
                    <span class="label-text-alt text-gray-600">Selecciona una nueva imagen solo si deseas cambiarla (JPG, PNG, máx. 2MB)</span>
                </label>
                
                <!-- Preview de nueva imagen -->
                <div id="imagePreview" class="hidden mt-4 p-4 bg-green-50 rounded-lg border border-green-200">
                    <p class="text-sm font-medium text-gray-900 mb-2">Vista previa de la nueva imagen:</p>
                    <img id="previewImg" src="/placeholder.svg" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-green-400 shadow-sm">
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                <a href="{{ route('tools.index') }}" 
                   class="btn btn-outline btn-error gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary gap-2 bg-green-600 hover:bg-green-700 border-green-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Actualizar Herramienta
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script para preview de imagen -->
<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').classList.add('hidden');
        }
    });
</script>
@endsection

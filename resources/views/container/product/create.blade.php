
@extends('dashboard')
@section('content')
<div data-theme="light" class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Added breadcrumb and improved header -->
        <div class="mb-6">
            <div class="text-sm breadcrumbs text-gray-600 mb-2">
                <ul>
                    <li><a href="{{ route('tools.index') }}" class="text-green-600 hover:text-green-700">Productos</a></li>
                    <li class="text-gray-900">Registrar Nuevo Producto</li>
                </ul>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Agregar Nuevo Producto</h1>
            <p class="text-gray-600 mt-1">Complete el formulario para registrar un nuevo producto en el inventario</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <!-- Improved error alerts with icon and forced dark text -->
            @if ($errors->any())
                <div class="alert bg-red-50 border border-red-200 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h3 class="font-bold text-red-900">Errores en el formulario</h3>
                        <ul class="list-disc pl-5 text-sm text-red-800 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Improved form with icons and better styling -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nombre -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-gray-900 font-semibold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Nombre de la Producto
                        </span>
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required 
                           placeholder="Ej: Martillo, Pala, Rastrillo"
                           class="input input-bordered w-full focus:input-primary text-gray-900 placeholder:text-gray-400">
                    <label class="label">
                        <span class="label-text-alt text-gray-600">Ingrese un nombre descriptivo para la Producto</span>
                    </label>
                </div>

                <!-- Estado -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-gray-900 font-semibold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Estado Inicial
                        </span>
                    </label>
                    <select name="estado" class="select select-bordered w-full focus:select-primary text-gray-900">
                        <option value="disponible" {{ old('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="agotado" {{ old('estado') == 'agotado' ? 'selected' : '' }}>Agotado</option>
                    </select>
                    <label class="label">
                        <span class="label-text-alt text-gray-600">Seleccione el estado actual de la Producto</span>
                    </label>
                </div>

                <!-- Stock -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-gray-900 font-semibold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Cantidad en Stock
                        </span>
                    </label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" required
                           placeholder="0"
                           class="input input-bordered w-full focus:input-primary text-gray-900 placeholder:text-gray-400">
                    <label class="label">
                        <span class="label-text-alt text-gray-600">Cantidad de unidades disponibles</span>
                    </label>
                </div>

                <!-- Imagen -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-gray-900 font-semibold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Imagen de la Producto
                        </span>
                    </label>
                    <input type="file" name="url_img" accept="image/*" required id="imageInput"
                           class="file-input file-input-bordered w-full focus:file-input-primary text-gray-900">
                    <label class="label">
                        <span class="label-text-alt text-gray-600">Formatos permitidos: JPG, PNG, GIF (máx. 2MB)</span>
                    </label>
                    
                    <!-- Added image preview -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="text-sm font-semibold text-gray-900 mb-2">Vista previa:</p>
                        <img id="previewImg" src="/placeholder.svg" alt="Preview" class="w-full max-w-xs rounded-lg border-2 border-gray-200">
                    </div>
                </div>

                <!-- Improved buttons with icons -->
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="btn btn-primary flex-1 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Guardar Producto
                    </button>
                    <a href="{{ route('tools.index') }}" class="btn btn-outline flex-1 text-gray-900 border-gray-300 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Added JavaScript for image preview -->
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
    }
});
</script>
@endsection
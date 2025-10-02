@extends('dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Header mejorado con icono y mejor diseño --}}
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <div class="bg-green-100 p-3 rounded-lg">
                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Catálogo de Productos</h1>
                <p class="text-gray-600 mt-1">Gestiona los productos e insumos agrícolas</p>
            </div>
        </div>
        @role('administrador')
        <a href="{{ route('products.create') }}" class="btn btn-primary gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nuevo Producto
        </a>
        @endrole
    </div>

    {{-- Alertas mejoradas con iconos y mejor diseño --}}
    @if(session('success'))
        <div class="alert bg-green-50 border-l-4 border-green-500 mb-6">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-gray-900 font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert bg-red-50 border-l-4 border-red-500 mb-6">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-gray-900 font-medium">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Grid de productos mejorado --}}
    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="card bg-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <figure class="relative">
                        <img src="{{ asset('storage/' . $product->url_img) }}" 
                             alt="{{ $product->nombre }}" 
                             class="h-56 w-full object-cover" />
                        {{-- Badge de stock con colores según disponibilidad --}}
                        @if($product->stock > 10)
                            <div class="badge badge-success absolute top-4 right-4 gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                En Stock
                            </div>
                        @elseif($product->stock > 0)
                            <div class="badge badge-warning absolute top-4 right-4 gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Bajo Stock
                            </div>
                        @else
                            <div class="badge badge-error absolute top-4 right-4 gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                Agotado
                            </div>
                        @endif
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title text-gray-900 text-lg">{{ $product->nombre }}</h2>
                        <div class="flex items-center gap-2 text-gray-700">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <span class="font-semibold">Stock disponible:</span>
                            <span class="text-gray-900 font-bold">{{ $product->stock }}</span>
                        </div>
                        
                        {{-- Formulario de descontar mejorado --}}
                        @if($product->stock > 0)
                        @role('usuario')
                            <form action="{{ route('products.prestar', $product) }}" method="POST" class="mt-4">
                                @csrf
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text text-gray-700 font-medium">Cantidad a descontar</span>
                                    </label>
                                    <div class="flex gap-2">
                                        <input 
                                            type="number" 
                                            name="cantidad" 
                                            value="1" 
                                            min="1" 
                                            max="{{ $product->stock }}" 
                                            class="input input-bordered flex-1 text-white"
                                            required
                                        />
                                        <button type="submit" class="btn btn-warning gap-2 text-white">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                            </svg>
                                            Descontar
                                        </button>
                                        
                                    </div>
                                </div>
                            </form>
                            @endrole                            
                        @else
                            <div class="alert alert-error mt-4">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-900 text-sm">Producto agotado</span>
                            </div>
                        @endif
                            @role('administrador')
                        {{-- Botones de acción mejorados con iconos --}}
                        <div class="card-actions justify-end mt-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-info gap-2 text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </a>

                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error gap-2 text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                        @endrole
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Estado vacío cuando no hay productos --}}
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay productos registrados</h3>
            <p class="text-gray-600 mb-6">Comienza agregando tu primer producto al catálogo</p>
            <a href="{{ route('products.create') }}" class="btn btn-primary gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Crear Primer Producto
            </a>
        </div>
    @endif
</div>
@endsection

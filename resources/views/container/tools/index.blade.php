@extends('dashboard')

@section('content')
    <div class="container mx-auto px-4 py-6">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Catálogo de Herramientas</h1>
                <p class="text-gray-600">Gestiona y administra las herramientas agrícolas disponibles</p>
            </div>
            @role('administrador')
            <a href="{{ route('tools.create') }}" class="btn btn-primary mt-4 md:mt-0 text-white">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva Herramienta
            </a>
            @endrole
        </div>

        {{-- Mensajes de éxito o error --}}
        @if (session('success'))
            <div class="alert alert-success shadow-lg mb-6 border-l-4 border-green-600">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-gray-900 font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error shadow-lg mb-6 border-l-4 border-red-600">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-gray-900 font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        {{-- Grid de Herramientas --}}
        @if($tools->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($tools as $tool)
                    <div class="card bg-white shadow-xl hover:shadow-2xl transition-shadow duration-300 border border-gray-200">
                        <figure class="relative">
                            <img src="{{ asset('storage/' . $tool->url_img) }}" 
                                 alt="{{ $tool->nombre }}"
                                 class="h-56 w-full object-cover" />
                            {{-- Badge de Stock --}}
                            <div class="absolute top-4 right-4">
                                @if($tool->stock > 10)
                                    <span class="badge badge-success text-white font-semibold px-3 py-3">
                                        Stock: {{ $tool->stock }}
                                    </span>
                                @elseif($tool->stock > 0)
                                    <span class="badge badge-warning text-gray-900 font-semibold px-3 py-3">
                                        Stock: {{ $tool->stock }}
                                    </span>
                                @else
                                    <span class="badge badge-error text-white font-semibold px-3 py-3">
                                        Sin Stock
                                    </span>
                                @endif
                            </div>
                        </figure>
                        
                        <div class="card-body">
                            <h2 class="card-title text-gray-900 text-xl font-bold">{{ $tool->nombre }}</h2>
                            
                            @if(isset($tool->descripcion))
                                <p class="text-gray-600 text-sm line-clamp-2">{{ $tool->descripcion }}</p>
                            @endif

                            <div class="divider my-2"></div>

                            {{-- Acciones según rol --}}
                            @role('usuario')
                                @if($tool->stock > 0)
                                    <form action="{{ route('tools.prestar', $tool) }}" method="POST" class="mt-4">
                                        @csrf
                                        <div class="flex items-center gap-3">
                                            <div class="form-control flex-1">
                                                <label class="label">
                                                    <span class="label-text text-gray-700 font-medium">Cantidad</span>
                                                </label>
                                                <input type="number" 
                                                       name="cantidad" 
                                                       value="1" 
                                                       min="1" 
                                                       max="{{ $tool->stock }}"
                                                       class="input input-bordered w-full text-gray-900 bg-white" 
                                                       required />
                                            </div>
                                            <button type="submit" class="btn btn-warning text-white mt-9">
                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                                </svg>
                                                Prestar
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div class="alert alert-warning mt-4">
                                        <span class="text-gray-900 text-sm">No hay stock disponible</span>
                                    </div>
                                @endif
                            @endrole

                            @role('administrador')
                                <div class="card-actions justify-end mt-4 gap-2">
                                    <a href="{{ route('tools.edit', $tool) }}" 
                                       class="btn btn-info btn-sm text-white">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Editar
                                    </a>

                                    <form action="{{ route('tools.destroy', $tool) }}" 
                                          method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar esta herramienta?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error btn-sm text-white">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            {{-- Estado vacío --}}
            <div class="flex flex-col items-center justify-center py-16">
                <svg class="w-24 h-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay herramientas disponibles</h3>
                <p class="text-gray-600 mb-6">Comienza agregando tu primera herramienta al catálogo</p>
                @role('administrador')
                    <a href="{{ route('tools.create') }}" class="btn btn-primary text-white">
                        Agregar Herramienta
                    </a>
                @endrole
            </div>
        @endif
    </div>
@endsection

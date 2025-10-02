@extends('dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-xl font-bold mb-6 text-black">Catálogo de Herramientas</h1>

        {{-- Mensajes de éxito o error --}}
        @if (session('success'))
            <div class="alert alert-success shadow-lg mb-4 text-black">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error shadow-lg mb-4 text-black">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @role('administrador')
        <a href="{{ route('tools.create') }}" class="btn btn-primary mb-4">Nueva herramienta</a>
        @endrole
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($tools as $tool)
                <div class="card bg-white shadow-xl">
                    <figure>
                        <img src="{{ asset('storage/' . $tool->url_img) }}" alt="{{ $tool->nombre }}"
                            class="h-48 w-full object-cover" />
                    </figure>
                    <div class="card-body text-black">
                        <h2 class="card-title text-black">{{ $tool->nombre }}</h2>
                        <p class="text-black">Stock: {{ $tool->stock }}</p>

                        @role('usuario')
                        {{-- Formulario de Préstamo --}}
                        <form action="{{ route('tools.prestar', $tool) }}" method="POST"
                            class="flex items-center gap-2 mt-2">
                            @csrf
                            <input type="number" name="cantidad" value="1" min="1" max="{{ $tool->stock }}"
                                class="input input-bordered w-20 text-white" />
                            <button type="submit" class="btn btn-sm btn-warning">Prestar</button>
                        </form>
                        @endrole
                        @role('administrador')
                        <div class="flex justify-between mt-4">
                            {{-- Editar --}}
                            <a href="{{ route('tools.edit', $tool) }}" class="btn btn-sm btn-info">Editar</a>

                            {{-- Eliminar --}}
                            <form action="{{ route('tools.destroy', $tool) }}" method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar esta herramienta?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error">Eliminar</button>
                            </form>
                        </div>
                        @endrole
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

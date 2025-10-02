@extends('dashboard')

@section('content')
<div class="container mx-auto">
    <h1 class="text-xl font-bold mb-6 text-black">Catálogo de Productos</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Nuevo producto</a>

    @if(session('success'))
        <div class="alert alert-success shadow-lg mb-4 text-black">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error shadow-lg mb-4 text-black">
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="card bg-white shadow-xl">
                <figure>
                    <img src="{{ asset('storage/' . $product->url_img) }}" 
                         alt="{{ $product->nombre }}" 
                         class="h-48 w-full object-cover" />
                </figure>
                <div class="card-body text-black">
                    <h2 class="card-title text-black">{{ $product->nombre }}</h2>
                    <p class="text-black">Stock: {{ $product->stock }}</p>
                    
                    {{-- Formulario para descontar --}}
                    @if($product->stock > 0)
                        <form action="{{ route('products.prestar', $product) }}" method="POST" class="flex items-center gap-2 mt-2">
                            @csrf
                            <input 
                                type="number" 
                                name="cantidad" 
                                value="1" 
                                min="1" 
                                max="{{ $product->stock }}" 
                                class="input input-bordered w-20 text-black" 
                            />
                            <button type="submit" class="btn btn-sm btn-warning">Descontar</button>
                        </form>
                    @else
                        <span class="badge badge-error">Agotado</span>
                    @endif

                    <div class="flex justify-between mt-4">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-info">Editar</a>

                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-error">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

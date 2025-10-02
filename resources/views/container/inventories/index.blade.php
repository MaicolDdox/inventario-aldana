@extends('dashboard')

@section('content')
<div data-theme="light" class="p-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Inventario</h1>

    {{-- Mensajes de éxito o error --}}
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

    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr class="bg-base-200">
                    <th class="text-gray-800">Item</th>
                    <th class="text-gray-800">Cantidad</th>
                    <th class="text-gray-800">Estado</th>
                    <th class="text-gray-800">Usuario</th>
                    <th class="text-gray-800">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                    <tr>
                        <td class="text-gray-700">
                            {{-- Mostrar nombre de herramienta o producto --}}
                            @if($inventory->tool)
                                🛠 {{ $inventory->tool->nombre }}
                            @elseif($inventory->product)
                                📦 {{ $inventory->product->nombre }}
                            @else
                                ❓ Desconocido
                            @endif
                        </td>
                        <td class="text-gray-700">{{ $inventory->cantidad }}</td>
                        <td>
                            <span class="badge {{ $inventory->devuelto ? 'badge-success' : 'badge-error' }}">
                                {{ $inventory->devuelto ? 'Devuelto' : 'Prestado' }}
                            </span>
                        </td>
                        <td class="text-gray-700">
                            {{ $inventory->user->name ?? 'Desconocido' }}
                        </td>
                        <td>
                            @if($inventory->tool && !$inventory->devuelto)
                                {{-- Solo las herramientas se devuelven --}}
                                @role('usuario')
                                <form action="{{ route('inventories.devolver', $inventory) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Devolver
                                    </button>
                                </form>
                                @endrole
                            @elseif($inventory->product)
                                {{-- Para productos no hay devolución --}}
                                <span class="text-gray-500 italic">N/A</span>
                            @else
                                <span class="text-gray-500 italic">No disponible</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


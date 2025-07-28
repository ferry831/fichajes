<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Trabajador') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Información del Trabajador</h3>
                <div class="mb-4">
                    <strong>Nombre:</strong> {{ $trabajador->nombre }}
                </div>
                <div class="mb-4">
                    <strong>Email:</strong> {{ $trabajador->email }}
                </div>
                <div class="mb-4">
                    <strong>NIF:</strong> {{ $trabajador->nif }}
                </div>
                <div class="mb-4">
                    <strong>PIN:</strong> {{ $trabajador->pin ?? 'No asignado' }}
                </div>
                <div class="mb-4">
                    <strong>Horas:</strong> {{ $trabajador->horas ?? 'No asignado' }}
                </div>
                
                <div class="mt-6 flex justify-end space-x-2">
                    <a href="{{ route('empresa.trabajadores.edit', $trabajador) }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Editar</a>
                    <a href="{{ route('empresa.trabajadores.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Volver a la lista</a>
                    <!-- <a href="{{ route('empresa.trabajadores.destroy', $trabajador) }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</a> -->
                    
                    <form action="{{ route('empresa.trabajadores.destroy', $trabajador) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

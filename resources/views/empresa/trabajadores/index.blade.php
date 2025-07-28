{{-- filepath: resources/views/admin/empresas/index.blade.php --}}
<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Trabajadores') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto min-w-full px-4 sm:px-5 lg:px-5">
            <div class=" flex items-right justify-between mb-4">
                <a href="{{ route('empresa.trabajadores.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Añadir Trabajador</a>
                <p>Tienes {{ $trabajadores->count() }} trabajadores</p>
            </div>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-400">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Horas</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($trabajadores as $trabajador)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $trabajador->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $trabajador->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $trabajador->horas }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('empresa.trabajadores.show', $trabajador) }}" class="text-blue-600 hover:underline mr-2">Info</a>
                                <a href="{{ route('empresa.trabajadores.edit', $trabajador) }}" class="text-yellow-600 hover:underline mr-2">Editar</a>
                                <form action="{{ route('empresa.trabajadores.destroy', $trabajador) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
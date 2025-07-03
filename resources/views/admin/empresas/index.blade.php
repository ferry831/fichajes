{{-- filepath: resources/views/admin/empresas/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Empresas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto min-w-full px-4 sm:px-5 lg:px-5">
            <div class=" flex items-right justify-between mb-4">
                <a href="{{ route('admin.empresas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Añadir Empresa</a>
            </div>
            <div class="mb-4">
                <form method="GET" action="{{ route('admin.empresas.index') }}" class="flex items-center space-x-2">
                    <input type="text" name="nombre" value="{{ request('nombre') }}" placeholder="Buscar por Nombre..." class="border border-gray-300 rounded-lg px-4 py-2 w-full" />
                    <input type="text" name="cif" value="{{ request('cif') }}" placeholder="Buscar por CIF..." class="border border-gray-300 rounded-lg px-4 py-2 w-full" />
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Buscar</button>
                </form>
            </div>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            
            <table class="min-w-full divide-y divide-gray-400">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Razón Social</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">CIF</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($empresas as $empresa)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $empresa->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $empresa->cif }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.empresas.show', $empresa) }}" class="text-blue-600 hover:underline mr-2">Info</a>
                                <a href="{{ route('admin.empresas.edit', $empresa) }}" class="text-yellow-600 hover:underline mr-2">Editar</a>
                                <form action="{{ route('admin.empresas.destroy', $empresa) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar empresa?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $empresas->links() }}
        </div>
    </div>
</x-app-layout>
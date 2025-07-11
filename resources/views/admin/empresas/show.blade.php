<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la Empresa') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Información de la Empresa</h3>
                <div class="mb-4">
                    <strong>Razón Social:</strong> {{ $empresa->razon_social }}
                </div>
                <div class="mb-4">
                    <strong>CIF:</strong> {{ $empresa->cif }}
                </div>
                <div class="mb-4">
                    <strong>CCC:</strong> {{ $empresa->ccc }}
                </div>
                <div class="mb-4">
                    <strong>Dirección:</strong> {{ $empresa->direccion }}
                </div>
                <div class="mb-4">
                    <strong>Estado:</strong> @if($empresa->activa) Activa @else Inactiva @endif
                </div>
                <div class="mb-4">
                    <strong>Administrador de la empresa:</strong> {{ $empresa->usuario->email }}
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <a href="{{ route('admin.empresas.edit', $empresa) }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Editar</a>

                    <form action="{{ route('admin.empresas.cambiarEstado', $empresa) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres dar de baja a esta empresa?')">
                        @csrf
                        @method('PATCH')
                        @if ($empresa->activa)
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Dar de baja</button>
                        @else
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Dar de alta</button>
                        @endif
                    </form>
                    <a href="{{ route('admin.empresas.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Volver a la lista</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

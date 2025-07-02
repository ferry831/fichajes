<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div>
                <a href="{{ route('admin.empresas.index') }}" class="btn btn-primary">Gestionar Empresas</a>
            </div>
            <div>
                <a href="{{ route('admin.empresas.create') }}" class="btn btn-secondary">Crear Nueva Empresa</a>
            </div>
            {{-- Agrega más accesos según funcionalidades --}}
        </div>
    </div>
</x-app-layout>
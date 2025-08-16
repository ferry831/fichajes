<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>   
    </x-slot>

    <div class="py-12">
        <div class="flex space-x-4 max-w-7xl mx-auto sm:px-6 lg:px-8 items-start">
            <div class="flex-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex-1 flex items-center justify-center p-6 text-gray-900">
                    {{ __("Gestiona la información de tus empleados") }}
                </div>
                <div class="flex justify-center p-0 mb-4">
                    <a href="{{ route('empresa.trabajadores.index') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Trabajadores</a>
                </div>
            </div>

            <div class="flex-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex-1 flex items-center justify-center p-6 text-gray-900">
                    {{ __("Gestiona los fichajes de tus empleados") }}
                </div>
                <div class="flex justify-center p-0 mb-4">
                    <a href="{{ route('empresa.fichajes.index') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Fichajes</a>
                </div>
            </div>

            <div class="flex-1 bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                <div class="flex-1 flex items-center justify-center p-6 text-gray-900">
                    {{ __("Gestiona las incidencias de tus empleados") }}
                </div>
                <div class="flex justify-center p-0 mb-4">
                    <a href="{{ route('empresa.incidencias.index') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Incidencias</a>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>

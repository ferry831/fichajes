<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>   
    </x-slot>

    <div class="py-12">
        <div class="flex space-x-4 max-w-7xl mx-auto sm:px-6 lg:px-8 items-start">
            <div class="flex-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Gestiona la información de tus empleados") }}
                </div>
            </div>

            <div class="flex-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Gestiona los fichajes de tus empleados") }}
                </div>
            </div>
            <div class="flex-1 bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                <div class="flex-1 flex items-center justify-center p-6 text-gray-900">
                    {{ __("¿No has fichado? ¡Ficha desde aquí!") }}
                </div>
                <div class="flex justify-center p-0 mb-4">
                    <a href="https://google.com" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Fichar</a>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>

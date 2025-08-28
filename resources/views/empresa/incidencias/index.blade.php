<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestiona las incidencias de tus empleados') }}
        </h2>
    </x-slot>

    <style>
        .active {
            border-color: blue; 
            color: blue; 
            font-weight: bold;
        }
        
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto min-w-full px-4 sm:px-5 lg:px-5">
            <!-- Pestañas -->
            <div class="mb-4  border-gray-200">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="incidenciasTabs" role="tablist">
                    <li class="mr-2">
                        <button class="inline-block p-4 border-b-2 transition-all duration-200 active" id="pendientes-tab" type="button" onclick="showTab('pendientes')">Pendientes</button>
                    </li>
                    <li class="mr-2">
                        <button class="inline-block p-4 border-b-2 transition-all duration-200 " id="historial-tab" type="button" onclick="showTab('historial')">Historial</button>
                    </li>
                </ul>
            </div>

            <!-- Tabla de incidencias pendientes -->
            <div id="pendientes-tab-content">
                @include('empresa.incidencias.partials.pendientes', ['incidencias' => $incidenciasPendientes])
            </div>
            <!-- Tabla de historial -->
            <div id="historial-tab-content" style="display:none;">
                @include('empresa.incidencias.partials.historial', ['incidencias' => $incidenciasHistorial])
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            document.getElementById('pendientes-tab-content').style.display = tab === 'pendientes' ? 'block' : 'none';
            document.getElementById('historial-tab-content').style.display = tab === 'historial' ? 'block' : 'none';
            document.getElementById('pendientes-tab').classList.toggle('active', tab === 'pendientes');
            document.getElementById('historial-tab').classList.toggle('active', tab === 'historial');
            
            
        }

        window.onload = function() {
                const params = new URLSearchParams(window.location.search);
                if (params.has('historial')) {
                    showTab('historial');
                } else {
                    showTab('pendientes');
                }
        }
    </script>
</x-app-layout>
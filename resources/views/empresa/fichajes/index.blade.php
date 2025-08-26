<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Fichajes') }}
        </h2>
    </x-slot>


        
    <div class="py-6">
        <div class="max-w-7xl mx-auto min-w-full px-4 sm:px-5 lg:px-5">

            <div class="mb-4">
                <x-input-label for="mes_o_semana" value="Ver los fichajes de tus empleados por:" />
                <select id="mes_o_semana" name="mes_o_semana" class="block w-full mt-1 rounded" required>
                    <option value="mes">Mes</option>
                    <option value="semana">Semana</option>
                </select>
            </div>

            

        <div id="tabla-mes" style="display:none;" class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-400">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Horas Contratadas</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Horas trabajadas</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Diferencia</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Historial</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    

                    @foreach($empleadosMes as $empleado)
                        @php
                            $totalHorasMes = 0;
                            foreach ($empleado->fichajes as $fichaje) {
                                if ($fichaje->hora_entrada && $fichaje->hora_salida) {
                                    $entrada = \Carbon\Carbon::parse($fichaje->hora_entrada);
                                    $salida = \Carbon\Carbon::parse($fichaje->hora_salida);
                                    $totalHorasMes += $entrada->diffInMinutes($salida) / 60; // Suma en horas
                                }
                            }
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $empleado->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $empleado->horas * 4 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ round($totalHorasMes, 2) }} h</td>
                            <td class="px-6 py-4 whitespace-nowrap @if($empleado->horas*4 < $totalHorasMes) text-green-600 @elseif($empleado->horas*4 > $totalHorasMes) text-red-600 @else text-gray-600 @endif">
                                {{-- Calcula la diferencia entre horas contratadas y trabajadas --}}
                                @php
                                    $diferencia = $empleado->horas*4 - $totalHorasMes;
                                @endphp
                                {{ round($diferencia, 2) }} h
                            </td>
                            <td class ="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('empresa.fichajes.show', $empleado->id) }}" class="text-blue-600 hover:underline">Ver historial</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="tabla-semana" style="display: none;" class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-400">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Horas Contratadas</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Horas trabajadas</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Diferencia</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Historial</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    

                    @foreach($empleadosSemana as $empleado)
                        @php
                            $totalHorasSemana = 0;
                            foreach ($empleado->fichajes as $fichaje) {
                                if ($fichaje->hora_entrada && $fichaje->hora_salida) {
                                    $entrada = \Carbon\Carbon::parse($fichaje->hora_entrada);
                                    $salida = \Carbon\Carbon::parse($fichaje->hora_salida);
                                    $totalHorasSemana += $entrada->diffInMinutes($salida) / 60; // Suma en horas
                                }
                            }
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $empleado->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $empleado->horas }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ round($totalHorasSemana, 2) }} h</td>
                            <td class="px-6 py-4 whitespace-nowrap @if($empleado->horas < $totalHorasSemana) text-green-600 @elseif($empleado->horas > $totalHorasSemana) text-red-600 @else text-gray-600 @endif">
                                {{-- Calcula la diferencia entre horas contratadas y trabajadas --}}
                                @php
                                    $diferencia = $empleado->horas - $totalHorasSemana;
                                @endphp
                                {{ round($diferencia, 2) }} h
                            </td>
                            <td class ="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('empresa.fichajes.show', $empleado->id) }}" class="text-blue-600 hover:underline">Ver historial</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            document.getElementById('mes_o_semana').addEventListener('change', function() {
                if (this.value === 'mes') {
                    document.getElementById('tabla-mes').style.display = '';
                    document.getElementById('tabla-semana').style.display = 'none';
                } else {
                    document.getElementById('tabla-mes').style.display = 'none';
                    document.getElementById('tabla-semana').style.display = '';
                }
            });
            // Inicializa la vista en "semana"
            document.getElementById('tabla-mes').style.display = '';
            document.getElementById('tabla-semana').style.display = 'none';
        </script>
    </div>
</x-app-layout>
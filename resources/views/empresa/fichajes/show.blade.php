<x-app-layout>
   <x-slot name="header">
        
        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestiona los fichajes de :nombre', ['nombre' => $trabajador->nombre]) }}
        </h2>
        
    </x-slot>

    

    <div class="py-6">
        
        <div class="max-w-7xl mx-auto min-w-full px-4 sm:px-5 lg:px-5">
            
            <div class="mb-4">
                <form method="GET" action="{{ route('empresa.fichajes.show', $trabajador) }}" class="flex items-center space-x-2">
                    <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}" placeholder="Buscar por Fecha Inicio..." class="border border-gray-300 rounded-lg px-4 py-2 w-full" />
                    <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" placeholder="Buscar por Fecha Fin..." class="border border-gray-300 rounded-lg px-4 py-2 w-full" />
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Buscar</button>
                    <a href="{{ route('empresa.fichajes.export.pdf', ['trabajador' => $trabajador, 'fecha_inicio' => request('fecha_inicio'), 'fecha_fin' => request('fecha_fin')]) }}" class="bg-red-600 text-white text-center px-4 py-2 rounded hover:bg-red-700 min-w-[150px]">
                        Exportar a PDF
                    </a>
                    <a href="{{ route('empresa.fichajes.export.excel', ['trabajador' => $trabajador, 'fecha_inicio' => request('fecha_inicio'), 'fecha_fin' => request('fecha_fin')]) }}" class="bg-green-600 text-white text-center px-4 py-2 rounded hover:bg-green-700 min-w-[150px]">
                        Exportar a Excel
                    </a>
                </form>
            </div>
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-fixed divide-y divide-gray-400 ">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="w-24 py-3 px-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Fecha</th>
                            <th class="w-24 py-3 px-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Entrada</th>
                            <th class="w-24 py-3 px-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Pausas</th>
                            <th class="w-24 py-3 px-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Duración</th>
                            <th class="w-24 py-3 px-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Salida</th>
                            <th class="w-24 py-3 px-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Total</th>
                            <th class="w-24 py-3 px-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Requeridas</th>
                            <th class="w-24 py-3 px-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Extras</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($fichajes as $fichaje)
                            <tr>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    {{ $fichaje->fecha ? ucfirst(\Carbon\Carbon::parse($fichaje->fecha)->locale('es')->isoFormat('D-MM-YYYY')) : '' }}
                                </td>

                                <td class="px-3 py-4 whitespace-nowrap">
                                    {{ $fichaje->hora_entrada ? \Carbon\Carbon::parse($fichaje->hora_entrada)->format('H:i') : '' }}
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    {{ $fichaje->pausas ? $fichaje->pausas->count() : 0 }}
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    @php
                                        $duracionTotalSegundos = 0;
                                        foreach ($fichaje->pausas as $pausa) {
                                            if ($pausa->inicio && $pausa->fin) {
                                                $duracionTotalSegundos += \Carbon\Carbon::parse($pausa->inicio)->diffInSeconds(\Carbon\Carbon::parse($pausa->fin));
                                            }
                                        }
                                        $minutos = floor($duracionTotalSegundos / 60);
                                        $segundos = $duracionTotalSegundos % 60;
                                    @endphp
                                    @if($duracionTotalSegundos)
                                        {{ $minutos}} min {{ $segundos }} seg
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="px-3 py-4 whitespace-nowrap">
                                    {{ $fichaje->hora_salida ? \Carbon\Carbon::parse($fichaje->hora_salida)->format('H:i') : '' }}
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    @if ($fichaje->hora_entrada && $fichaje->hora_salida)
                                        @php
                                            $entrada = \Carbon\Carbon::parse($fichaje->hora_entrada);
                                            $salida = \Carbon\Carbon::parse($fichaje->hora_salida);
                                            $total = $entrada->diffInMinutes($salida);

                                            if ($fichaje->pausa_inicio && $fichaje->pausa_fin) {
                                                $pausa = \Carbon\Carbon::parse($fichaje->pausa_inicio)->diffInMinutes(\Carbon\Carbon::parse($fichaje->pausa_fin));
                                                $total -= $pausa;
                                            }
                                            // Convierte a horas y minutos
                                            $horas_decimales = round($total / 60, 2);

                                        @endphp
                                        {{ $horas_decimales }} h
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    {{ $trabajador->horas / 5 }} h
                                </td>
                                <td class="px-3 py-4 whitespace-nowrap">
                                    @if ($fichaje->hora_entrada && $fichaje->hora_salida)
                                        @php
                                            
                                            $horas_requeridas = $trabajador->horas / 5;
                                            $horas_extra = $horas_decimales - $horas_requeridas;
                                            
                                        @endphp
                                        @if($horas_extra > 0)
                                            {{ round($horas_extra, 2) }} h
                                        @else
                                            0
                                        @endif
                                    
                                    @endif
                                    
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>
            <div class="mt-4">
                {{ $fichajes->links() }}
            </div>
            <div class="mt-4">
                <a href="{{ route('empresa.fichajes.index') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    ← Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
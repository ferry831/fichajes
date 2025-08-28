<table style="margin-bottom: 8px; font-size: x-small;">
    <thead>
        <tr>
            <th><strong>Fecha inicio</strong></th>
            <th><strong>Fecha fin</strong></th>
        </tr>
    </thead>
    <tbody>
        <tr>
        
            <td>
                @if(request('fecha_inicio'))
                    {{ \Carbon\Carbon::parse(request('fecha_inicio'))->format('d/m/Y') }}
                @else
                    -
                @endif
            </td>
            <td>
                @if(request('fecha_fin'))
                    {{ \Carbon\Carbon::parse(request('fecha_fin'))->format('d/m/Y') }}
                @else
                    -
                @endif
            </td>
        </tr>
    </tbody>
    
</table>

<h2> Fichajes de {{ $trabajador->nombre }}</h2>
<table width="100%" style="margin-bottom: 16px; font-size: x-small;">
    <tr>
        <td id="fecha" align="left">
            <h3>{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</h3>
        </td>
        <td id="empresa" align="right">
            <h3>{{ $trabajador->empresa->razon_social }}</h3>
        </td>
    </tr>
</table>

<table class="min-w-full divide-y divide-gray-400">
    <thead class="bg-gray-100">
        <tr>
            <th class="w-24 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Fecha</th>
            <th class="w-24 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Entrada</th>
            <th class="w-24 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Pausas</th>
            <th class="w-24 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Duración</th>
            <th class="w-24 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Salida</th>
            <th class="w-24 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Total</th>
            <th class="w-64 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Requeridas</th>
            <th class="w-64 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Extra</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach($fichajes as $fichaje)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $fichaje->fecha ? ucfirst(\Carbon\Carbon::parse($fichaje->fecha)->locale('es')->isoFormat('D-MM-YYYY')) : '' }}
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $fichaje->hora_entrada ? \Carbon\Carbon::parse($fichaje->hora_entrada)->format('H:i') : '' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $fichaje->pausas ? $fichaje->pausas->count() : 0 }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
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

                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $fichaje->hora_salida ? \Carbon\Carbon::parse($fichaje->hora_salida)->format('H:i') : '' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
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
                        {{ $horas_decimales }}
                    @else
                        -
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $trabajador->horas / 5 }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if ($fichaje->hora_entrada && $fichaje->hora_salida)
                        @php

                            $horas_requeridas = $trabajador->horas / 5;
                            $horas_extra = $horas_decimales - $horas_requeridas;

                        @endphp
                        @if($horas_extra > 0)
                            {{ round($horas_extra, 2) }}
                        @else
                            0
                        @endif

                    @endif

                </td>

            </tr>
        @endforeach
        @php
            $totalHorasExtra = 0;
        @endphp
        @foreach ($fichajes as $fichaje)
            @php

                $horasTrabajador = $trabajador->horas / 5;
                $horas_trabajadas = null;
                if ($fichaje->hora_entrada && $fichaje->hora_salida) {
                    $entrada = \Carbon\Carbon::parse($fichaje->hora_entrada);
                    $salida = \Carbon\Carbon::parse($fichaje->hora_salida);
                    $total = $entrada->diffInMinutes($salida);

                    if ($fichaje->pausa_inicio && $fichaje->pausa_fin) {
                        $pausa = \Carbon\Carbon::parse($fichaje->pausa_inicio)->diffInMinutes(\Carbon\Carbon::parse($fichaje->pausa_fin));
                        $total -= $pausa;
                    }
                    $horas_trabajadas = $total / 60;
                    $horas_extra = $horas_trabajadas - $horasTrabajador;
                    if ($horas_extra > 0) {
                        $totalHorasExtra += $horas_extra;
                    }
                }
            @endphp
        @endforeach
        <tr>
            <td colspan="7" class="font-bold text-right">Total horas extra:</td>
            <td class="font-bold">{{ number_format($totalHorasExtra, 2) }}</td>
        </tr>
    </tbody>
</table>

<h2>Incidencias</h2>
<table class="min-w-full divide-y divide-gray-400 max-w-[80%]">
    <thead class="bg-gray-100">
        <tr>
            
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Fecha inicial</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Fecha final</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tipo</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Subtipo</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider max-w-xs">
                Observaciones</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Estado</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">

        @if($incidencias->isEmpty())

            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">No hay incidencias pendientes</td>
            </tr>
        @endif
        @foreach($incidencias as $incidencia)
            <tr>

                

                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $incidencia->fecha_inicio ? \Carbon\Carbon::parse($incidencia->fecha_inicio)->format('d/m/Y H:i') : '' }}
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $incidencia->fecha_fin ? \Carbon\Carbon::parse($incidencia->fecha_fin)->format('d/m/Y H:i') : '' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $incidencia->tipo }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $incidencia->subtipo }}</td>
                <td class="px-6 py-4 max-w-xs break-words overflow-hidden">{{ $incidencia->observacion }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php
                        $estado = $incidencia->estado;
                    @endphp
                    @if($estado === 'aprobada')
                        <span class="text-green-500">Aprobada</span>
                    @else
                        <span class="text-red-500">Rechazada</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        
        #principal {
            font-family: Arial, Helvetica, sans-serif;
            border: 1px solid black;
            border-collapse: collapse;
        }
        #principal th {
            font-family: Arial, Helvetica, sans-serif;
            border: 1px solid black;
            padding: 2px 4px;
        }
        #principal td, {
            font-family: Arial, Helvetica, sans-serif;
            border: 1px solid black;
            padding: 2px 4px;
            font-size: x-small;
        }
        #fechas {
            font-size: small;
        }

    </style>
</head>

<body>
    <table width="100%" style="margin-bottom: 16px; font-size: x-small;">
        <tr>
            <td id="fecha" align="left">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</td>
            <td id="empresa" align="right">{{ $trabajador->empresa->razon_social }}</td>
        </tr>
    </table>

    <p id="fechas">
        @if(request('fecha_inicio') && request('fecha_fin'))
            Intervalo seleccionado: <strong>{{ \Carbon\Carbon::parse(request('fecha_inicio'))->format('d/m/Y') }}</strong>
            a <strong>{{ \Carbon\Carbon::parse(request('fecha_fin'))->format('d/m/Y') }}</strong>
        @elseif(request('fecha_inicio'))
            Desde: <strong>{{ \Carbon\Carbon::parse(request('fecha_inicio'))->format('d/m/Y') }}</strong>
        @elseif(request('fecha_fin'))
            Hasta: <strong>{{ \Carbon\Carbon::parse(request('fecha_fin'))->format('d/m/Y') }}</strong>
        @else
            Mostrando todos los registros
        @endif
    </p>
    <h2> Fichajes de {{ $trabajador->nombre }}</h2>
    <table id="principal" class="min-w-full divide-y divide-gray-400">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Fecha</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Entrada</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Pausas</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Duración</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Salida</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Total</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Requeridas</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Extra</th>
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
                    
                    $horasTrabajador = $trabajador->horas/5;
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
    <table id = "principal" class="min-w-full divide-y divide-gray-400 max-w-[80%]">
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

</body>

</html>
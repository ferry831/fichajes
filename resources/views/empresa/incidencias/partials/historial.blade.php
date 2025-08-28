<table class="min-w-full divide-y divide-gray-400 ">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nombre</th>
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

                <td class="px-6 py-4 whitespace-nowrap">{{ $incidencia->trabajador->nombre }}</td>

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
<div class="py-3">
    {{ $incidencias->links() }}
</div>
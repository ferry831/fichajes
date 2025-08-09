<x-app-layout>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestiona las incidencias de tus empleados') }}
        </h2>
    </x-slot>

    

    <div class="py-6">
        <div class="max-w-7xl mx-auto min-w-full px-4 sm:px-5 lg:px-5">
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-400">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Fecha inicial</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Fecha final</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Subtipo</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Observaciones</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Acciones</th>
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
                                <td class="px-6 py-4 whitespace-nowrap">{{ $incidencia->observacion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                  
                                
                                <form action="{{ route('empresa.incidencias.update', $incidencia->id) }}" method="POST">
                                      @csrf
                                      @method('PATCH')
                                      <button type="submit" name="accion" value="aprobar" class="text-green-600 hover:text-green-900 px-2">Aprobar</button>
                                      <button type="submit" name="accion" value="rechazar" class="text-red-600 hover:text-red-900">Rechazar</button>
                                </form>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
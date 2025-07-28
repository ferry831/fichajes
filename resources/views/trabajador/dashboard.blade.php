<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-4 lg:max-w-7xl mx-auto sm:px-6 lg:px-8 items-center">
        
        <div class="w-full lg:flex-1 min-w-[160px] bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('fichajes.entrada') }}" method="POST">
                @csrf
                <button type="submit" 
                    class="flex items-center bg-green-600 text-white px-4 py-4 rounded hover:bg-green-700 text-xl w-full justify-start {{ $fichaje && $fichaje->hora_entrada && !$fichaje->hora_salida ? 'opacity-50 cursor-not-allowed' : 'hover:bg-green-700' }}"
                    @if($fichaje && $fichaje->hora_entrada && !$fichaje->hora_salida) disabled @endif
                >
                    <div class="flex items-center justify-start w-1/2">
                        <img src="{{ asset('images/entry.png') }}" alt="Fichar" class="h-16">
                    </div>
                    <div class="flex items-center justify-start w-1/2">
                        <span>Comenzar</span>
                    </div>
                </button>
            </form>
        </div>

         <div class="w-full lg:flex-1 min-w-[160px] bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('fichajes.pausa', $fichaje ? $fichaje->id : 0) }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center bg-green-600 text-white px-4 py-4 rounded text-xl w-full justify-start
                    {{ !$fichaje || !$fichaje->hora_entrada || $fichaje->hora_salida || ($fichaje->pausas->last() && !$fichaje->pausas->last()->fin) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-green-700' }}"
                    @if(!$fichaje || !$fichaje->hora_entrada || $fichaje->hora_salida || ($fichaje->pausas->last() && !$fichaje->pausas->last()->fin)) disabled @endif
                >                   
                    <div class="flex items-center justify-start w-1/2">
                        <img src="{{ asset('images/pause.png') }}" alt="Fichar" class="h-16">
                    </div>
                    <div class="flex items-center justify-start w-1/2">
                        <span>Pausar</span>
                    </div>
                </button>
            </form>
        </div>

        <div class="w-full lg:flex-1 min-w-[160px] bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('fichajes.reanudar', $fichaje ? $fichaje->id : 0) }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center bg-green-600 text-white px-4 py-4 rounded text-xl w-full justify-start
                    {{ !$fichaje || !$fichaje->hora_entrada || $fichaje->hora_salida || !($fichaje->pausas->last() && !$fichaje->pausas->last()->fin) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-green-700' }}"
                    @if(!$fichaje || !$fichaje->hora_entrada || $fichaje->hora_salida || !($fichaje->pausas->last() && !$fichaje->pausas->last()->fin)) disabled @endif
                >                    
                    <div class="flex items-center justify-start w-1/2">
                        <img src="{{ asset('images/play.png') }}" alt="Fichar" class="h-16">
                    </div>
                    <div class="flex items-center justify-start w-1/2">
                        <span>Reanudar</span>
                    </div>
                </button>
            </form>
        </div>

        <div class="w-full lg:flex-1 min-w-[160px] bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('fichajes.salida', $fichaje ? $fichaje->id : 0) }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center bg-green-600 text-white px-4 py-4 rounded text-xl w-full justify-start
                    {{ !$fichaje || !$fichaje->hora_entrada || $fichaje->hora_salida || ($fichaje->pausas->last() && !$fichaje->pausas->last()->fin) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-green-700' }}"
                    @if(!$fichaje || !$fichaje->hora_entrada || $fichaje->hora_salida || ($fichaje->pausas->last() && !$fichaje->pausas->last()->fin)) disabled @endif
                >
                    <div class="flex items-center justify-start w-1/2">
                        <img src="{{ asset('images/exit.png') }}" alt="Fichar" class="h-16">
                    </div>
                    <div class="flex items-center justify-start w-1/2">
                        <span>Finalizar</span>
                    </div>
                </button>
            </form>
        </div>

    </div>
</div>
</x-app-layout>

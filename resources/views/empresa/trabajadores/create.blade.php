<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Añadir nuevo trabajador') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Añadir información del trabajador</h3>
                <form action="{{ route('empresa.trabajadores.store') }}" method="POST" class="space-y-4">
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    
                                       
                    <div class = "mb-4">
                        <label class="block font-semibold mb-1" for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required value="{{ old('nombre') }}">
                        @error('nombre')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <label class="block font-semibold mb-1 mt-4" for="nif">NIF:</label>
                        <input type="text" name="nif" id="nif" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required minlength="9" maxlength="9"">
                       

                        <label class="block font-semibold mb-1" for="email">Email:</label>
                        <input type="email" name="trabajador_email" id="trabajador_email" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required value="{{ old('trabajador_email') }}">
                        @error('trabajador_email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <label class="block font-semibold mb-1 mt-4" for="nif">Horas:</label>
                        <input type="text" name="horas" id="horas" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required min="0" max="168">
                        @error('horas')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <label class="block font-semibold mb-1 mt-4" for="pin">PIN:</label>
                        <input type="password" name="pin" id="pin" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required minlength="4" maxlength="4"
                        oninvalid="this.setCustomValidity('El PIN debe tener exactamente 4 caracteres')">
                        @error('pin')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <label class="block font-semibold mb-1 mt-4" for="pin_confirmation">Confirmar PIN:</label>
                        <input type="password" name="pin_confirmation" id="pin_confirmation" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required minlength="4" maxlength="4">
                        @if ($errors->has('pin_confirmation'))
                            @if (str_contains($errors->first('pin_confirmation'), 'confirmation'))
                                <span class="text-red-600 text-sm">El PIN no coincide con el anterior.</span>
                            @else
                                <span class="text-red-600 text-sm">{{ $errors->first('pin') }}</span>
                            @endif
                        @endif

                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir Trabajador</button>
                        <a href="{{ route('empresa.trabajadores.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

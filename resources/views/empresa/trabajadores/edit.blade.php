<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar información del Trabajador') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Editar información del Trabajador</h3>
                <form action="{{ route('empresa.trabajadores.update', $trabajador) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $trabajador->nombre) }}" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $trabajador->email) }}" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" for="nif">NIF:</label>
                        <input type="text" name="nif" id="nif" value="{{ old('nif', $trabajador->nif) }}" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required minlength="9" maxlength="9" pattern="^[0-9]{8}[A-Za-z]$" 
                        oninvalid="this.setCustomValidity('El NIF no cumple con el formato requerido')" 
                        oninput="this.setCustomValidity('')">
                         @error('cif')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" for="pin">PIN:</label>
                        <input type="text" name="pin" id="pin" value="{{ old('pin', $trabajador->pin) }}" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required minlength="4" maxlength="4" pattern="^[0-9]{4}$">
                    </div>
                
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" for="horas">Horas:</label>
                        <input type="number" name="horas" id="horas" value="{{ old('horas', $trabajador->horas) }}" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required min="0">
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar cambios</button>
                        <a href="{{ route('empresa.trabajadores.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

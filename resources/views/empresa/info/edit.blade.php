<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar información de Empresa') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Editar información de la Empresa</h3>
                <form action="{{ route('empresa.info.update', $empresa) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" for="razon_social">Razón Social:</label>
                        <input type="text" name="razon_social" id="razon_social" value="{{ old('razon_social', $empresa->razon_social) }}" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" for="cif">CIF:</label>
                        <input type="text" name="cif" id="cif" value="{{ old('cif', $empresa->cif) }}" 
                        class="border border-gray-300 rounded-lg px-4 py-2 w-full" 
                        required minlength="9" maxlength="9" pattern="^[A-Za-z][0-9]{7}[A-Za-z0-9]$"
                        oninvalid="this.setCustomValidity('El CIF no cumple con el formato requerido')" 
                        oninput="this.setCustomValidity('')">
                        @error('cif')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="mb-4">
                        <label class="block font-semibold mb-1" for="ccc">CCC:</label>
                        <input type="text" name="ccc" id="ccc" value="{{ old('ccc', $empresa->ccc) }}" 
                        class="border border-gray-300 rounded-lg px-4 py-2 w-full" required minlength="11" maxlength="11" pattern="^[0-9]{11}$"
                        oninvalid="this.setCustomValidity('El CCC debe tener 11 dígitos')" 
                        oninput="this.setCustomValidity('')">
                        @error('ccc')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" for="direccion">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $empresa->direccion) }}" class="border border-gray-300 rounded-lg px-4 py-2 w-full">
                    </div>
                    <!-- <div class="mb-4">
                        <label class="block font-semibold mb-1" for="activa">Estado:</label>
                        <select name="activa" id="activa" class="border border-gray-300 rounded-lg px-4 py-2 w-full">
                            <option value="1" @if(old('activa', $empresa->activa)) selected @endif>Activa</option>
                            <option value="0" @if(!old('activa', $empresa->activa)) selected @endif>Inactiva</option>
                        </select>
                    </div> -->
                    <div class="flex justify-end space-x-2">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar cambios</button>
                        <a href="{{ route('empresa.info.show') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

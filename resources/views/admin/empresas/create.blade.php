<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Añadir nueva empresa') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Añadir información de la empresa</h3>
                <form action="{{ route('admin.empresas.store') }}" method="POST" class="space-y-4">
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
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" for="razon_social">Razón Social:</label>
                        <input type="text" name="razon_social" id="razon_social" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required value="{{ old('razon_social') }}">
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1" for="cif">CIF:</label>
                        <input type="text" name="cif" id="cif" class="border border-gray-300 rounded-lg px-4 py-2 w-full" 
                        required minlength="9" maxlength="9" pattern="^[A-Za-z][0-9]{7}[A-Za-z0-9]$"
                        oninvalid="this.setCustomValidity('El CIF no cumple con el formato requerido')" 
                        oninput="this.setCustomValidity('')" value="{{ old('cif') }}">
                        @error('cif')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="mb-4">
                        <label class="block font-semibold mb-1" for="ccc">CCC:</label>
                        <input type="text" name="ccc" id="ccc" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required minlength="11" maxlength="11" pattern="^[0-9]{11}$"
                        oninvalid="this.setCustomValidity('El CCC debe tener 11 dígitos')" 
                        oninput="this.setCustomValidity('')" value="{{ old('ccc') }}">
                        @error('ccc')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                   <div class="mb-4">
                        <label class="block font-semibold mb-1" for="direccion">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required value="{{ old('direccion') }}">
                    </div>

                    <hr class="my-6 border-gray-300">                    
                    <div class = "mb-4">
                        <h3 class="text-lg font-semibold mb-4">Añadir usuario administrador de la empresa</h3>
                        <label class="block font-semibold mb-1" for="email">Email:</label>
                        <input type="email" name="empresa_email" id="empresa_email" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required value="{{ old('empresa_email') }}">
                        @error('empresa_email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <label class="block font-semibold mb-1 mt-4" for="empresa_password">Contraseña:</label>
                        <input type="password" name="empresa_password" id="empresa_password" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required minlength="8" maxlength="255"
                        oninvalid="this.setCustomValidity('La contraseña debe tener al menos 8 caracteres')">
                        @error('empresa_password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <label class="block font-semibold mb-1 mt-4" for="empresa_password_confirmation">Confirmar contraseña:</label>
                        <input type="password" name="empresa_password_confirmation" id="empresa_password_confirmation" class="border border-gray-300 rounded-lg px-4 py-2 w-full" required minlength="8" maxlength="255">
                        @if ($errors->has('empresa_password'))
                            @if (str_contains($errors->first('empresa_password'), 'confirmation'))
                                <span class="text-red-600 text-sm">La contraseña no coincide con la anterior.</span>
                            @else
                                <span class="text-red-600 text-sm">{{ $errors->first('empresa_password') }}</span>
                            @endif
                        @endif

                    </div>
                  
                    <div class="flex justify-end space-x-2">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir Empresa</button>
                        <a href="{{ route('admin.empresas.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

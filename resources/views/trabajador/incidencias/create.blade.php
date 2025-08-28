<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generar incidencia') }}
        </h2>
    </x-slot>

        @if(session('success'))
            <div id="success-banner" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div id="error-banner" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    const successBanner = document.getElementById('success-banner');
                    const errorBanner = document.getElementById('error-banner');
                    if (successBanner) {
                        successBanner.style.display = 'none';
                    }
                    if (errorBanner) {
                        errorBanner.style.display = 'none';
                    }
                }, 3000);
            });
        </script>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-4">
                        @foreach($errors->all() as $error)
                            <div class="text-red-600">{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('trabajador.incidencias.store') }}" method="POST" onsubmit="return true;">
                    @csrf
                    
                    <div class="mb-4">
                        <x-input-label for="tipo_principal" value="Tipo de incidencia" />
                            <select id="tipo_principal" name="tipo_principal" class="block w-full mt-1 rounded" required>
                                <option value="">Selecciona tipo</option>
                                <option value="fichaje">Fichaje</option>
                                <option value="ausencia">Ausencia</option>
                                <option value="vacaciones">Vacaciones</option>
                            </select>
                    </div>

                        {{-- Subtipos dinámicos --}}
                    <div id="subtipo-fichaje" class="mb-4" style="display:none;">
                        <x-input-label for="subtipo_fichaje" value="Subtipo de fichaje" />
                            <select id="subtipo_fichaje" name="subtipo_fichaje" class="block w-full mt-1 mb-4 rounded">
                                <option value="fichaje_olvidado">Fichaje olvidado</option>
                                <option value="correccion_fichaje">Corrección de fichaje</option>
                            </select>

                        <x-input-label for="fecha" value="Fecha" />
                        <input type="date" id="fecha" name="fecha" class="block w-full mt-1 rounded" />
                        <x-input-label for="hora_entrada" value="Hora entrada" class="mt-2" />
                        <input type="time" id="hora_entrada" name="hora_entrada" class="block w-full mt-1 rounded" />
                        <x-input-label for="hora_salida" value="Hora salida" class="mt-2" />
                        <input type="time" id="hora_salida" name="hora_salida" class="block w-full mt-1 rounded" />

                    </div>

                    <div id="subtipo-ausencia" class="mb-4" style="display:none;">
                        <x-input-label for="subtipo_ausencia" value="Subtipo de ausencia" />
                        <select id="subtipo_ausencia" name="subtipo_ausencia" class="block w-full mt-1 mb-4 rounded">
                            <option value="baja_medica">Baja médica</option>
                            <option value="paternidad_maternidad">Paternidad/Maternidad</option>
                            <option value="fallecimiento_familiar">Fallecimiento familiar</option>
                            <option value="cita_medica">Cita médica</option>
                            <option value="deber_judicial">Deber inexcusable o judicial</option>
                            <option value="examenes_oficiales">Exámenes oficiales</option>
                            <option value="motivos_personales">Motivos personales</option>
                            <option value="asuntos_propios">Asuntos propios (si el convenio lo permite)</option>
                            <option value="mudanza">Permiso por mudanza</option>
                            <option value="matrimonio">Permiso por matrimonio</option>
                        </select>


                        <x-input-label for="fecha_inicio" value="Fecha inicio" />
                        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="block w-full mt-1 rounded" />
                        <x-input-label for="fecha_fin" value="Fecha fin" class="mt-2" />
                        <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="block w-full mt-1 rounded" />

                    </div>

                    <div id="subtipo-vacaciones" class="mb-4" style="display:none;">
                        <x-input-label for="fecha_inicio" value="Fecha inicio" />
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="block w-full mt-1 rounded" />
                        <x-input-label for="fecha_fin" value="Fecha fin" class="mt-2" />
                        <input type="date" id="fecha_fin" name="fecha_fin" class="block w-full mt-1 rounded" />
                    </div>

                    {{-- Observaciones --}}
                    <div class="mb-4">
                        <x-input-label for="observaciones" value="Observaciones" />
                        <textarea id="observaciones" name="observaciones" class="block w-full mt-1 rounded"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Enviar incidencia
                    </button>
                </form>

                <script>
                    function setDisabledCampos(bloqueId, disabled) {
                        const bloque = document.getElementById(bloqueId);
                        if (!bloque) return;
                        bloque.querySelectorAll('input, select, textarea').forEach(el => {
                            el.disabled = disabled;
                        });
                    }

                    function mostrarSubtipos() {
                        ['subtipo-fichaje', 'subtipo-ausencia', 'subtipo-vacaciones'].forEach(id => {
                            document.getElementById(id).style.display = 'none';
                            setDisabledCampos(id, true);
                        });

                        if (tipo.value === 'fichaje') {
                            document.getElementById('subtipo-fichaje').style.display = 'block';
                            setDisabledCampos('subtipo-fichaje', false);
                        } else if (tipo.value === 'ausencia') {
                            document.getElementById('subtipo-ausencia').style.display = 'block';
                            setDisabledCampos('subtipo-ausencia', false);
                        } else if (tipo.value === 'vacaciones') {
                            document.getElementById('subtipo-vacaciones').style.display = 'block';
                            setDisabledCampos('subtipo-vacaciones', false);
                        }
                    }

                    const tipo = document.getElementById('tipo_principal');
                    tipo.addEventListener('change', mostrarSubtipos);
                    document.addEventListener('DOMContentLoaded', mostrarSubtipos);
                </script>

                
            </div>
        </div>
    </div>
</x-app-layout>

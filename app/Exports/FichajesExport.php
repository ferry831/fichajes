<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Trabajador;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class FichajesExport implements FromView, WithColumnWidths
{
    protected $trabajador;
   

    protected $request;

    public function __construct(Trabajador $trabajador, $request)
    {
        $this->trabajador = $trabajador;
        $this->request = $request;
        
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18, 
            'B' => 18, 
            'C' => 18, 
            'D' => 18, 
            'E' => 18, 
            'F' => 38, 
            'G' => 18, 
            'H' => 18, 
        ];
    }

    public function view(): View
    {

        // Filtros para fichajes
        $fichajesQuery = $this->trabajador->fichajes()->orderBy('fecha', 'desc');
        if ($this->request->filled('fecha_inicio')) {
            $fichajesQuery->where('fecha', '>=', $this->request->input('fecha_inicio'));
        }
        if ($this->request->filled('fecha_fin')) {
            $fichajesQuery->where('fecha', '<=', $this->request->input('fecha_fin'));
        }
        $fichajes = $fichajesQuery->get();

        // Incidencias (mismos filtros opcionalmente por fecha_inicio / fecha_fin)
        $incidenciasQuery = $this->trabajador->incidencias()->orderBy('fecha_inicio', 'desc');
        if ($this->request->filled('fecha_inicio')) {
            $incidenciasQuery->where('fecha_inicio', '>=', $this->request->input('fecha_inicio'));
        }
        if ($this->request->filled('fecha_fin')) {
            $incidenciasQuery->where('fecha_fin', '<=', $this->request->input('fecha_fin'));
        }
        $incidencias = $incidenciasQuery->get();

        return view('empresa.fichajes.excel', [
            'trabajador' => $this->trabajador,
            'fichajes' => $fichajes,
            'incidencias' => $incidencias,
        ]);
    }
}
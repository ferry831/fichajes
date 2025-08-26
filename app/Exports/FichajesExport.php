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
            'A' => 15, 
            'B' => 15, 
            'C' => 15, 
            'D' => 15, 
            'E' => 15, 
            'F' => 15, 
            'G' => 15, 
            'H' => 15, 
        ];
    }

    public function view(): View
    {
        $query = $this->trabajador->fichajes()->orderBy('fecha', 'desc');
        if ($this->request->filled('fecha_inicio')) {
            $query->where('fecha', '>=', $this->request->input('fecha_inicio'));
        }
        if ($this->request->filled('fecha_fin')) {
            $query->where('fecha', '<=', $this->request->input('fecha_fin'));
        }
        $fichajes = $query->get();

        return view('empresa.fichajes.excel', [
            'trabajador' => $this->trabajador,
            'fichajes' => $fichajes,
        ]);
    }
}
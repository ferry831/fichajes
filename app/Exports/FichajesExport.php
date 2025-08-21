<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Trabajador;
use Illuminate\Contracts\View\View;

class FichajesExport implements FromView
{
    protected $trabajador;
    protected $request;

    public function __construct(Trabajador $trabajador, $request)
    {
        $this->trabajador = $trabajador;
        $this->request = $request;
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
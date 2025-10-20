<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    /**
     * Display the report view, optionally with results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // This method will now handle both the initial display and showing results.
        $validated = $request->validate([
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $prestamos = collect();
        $fecha_inicio = null;
        $fecha_fin = null;

        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $fecha_inicio = $validated['fecha_inicio'];
            $fecha_fin = $validated['fecha_fin'];

            $fechaInicioParsed = Carbon::parse($fecha_inicio)->startOfDay();
            $fechaFinParsed = Carbon::parse($fecha_fin)->endOfDay();

            $prestamos = Prestamo::with(['equipo.marca', 'persona', 'encargado.user', 'estado'])
                ->whereBetween('fecha_prestamo', [$fechaInicioParsed, $fechaFinParsed])
                ->orderBy('fecha_prestamo', 'asc')
                ->get();
        }

        return view('reportes.index', [
            'prestamos' => $prestamos,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
        ]);
    }

    /**
     * Generate a PDF report of the loans.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pdf(Request $request)
    {
        $validated = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        try {
            $fecha_inicio = $validated['fecha_inicio'];
            $fecha_fin = $validated['fecha_fin'];

            $fechaInicioParsed = Carbon::parse($fecha_inicio)->startOfDay();
            $fechaFinParsed = Carbon::parse($fecha_fin)->endOfDay();

            $prestamos = Prestamo::with(['equipo.marca', 'persona', 'encargado.user', 'estado'])
                ->whereBetween('fecha_prestamo', [$fechaInicioParsed, $fechaFinParsed])
                ->orderBy('fecha_prestamo', 'asc')
                ->get();

            $pdf = PDF::loadView('reportes.pdf', [
                'prestamos' => $prestamos,
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
            ]);

            return $pdf->stream('reporte-prestamos.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo generar el reporte en PDF. El error puede deberse a un conjunto de datos demasiado grande o a un problema con la plantilla.');
        }
    }

    /**
     * Generate a PDF report of all loans.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfAll()
    {
        try {
            $prestamos = Prestamo::with(['equipo.marca', 'persona', 'encargado.user', 'estado'])
                ->orderBy('fecha_prestamo', 'asc')
                ->get();

            // Pre-emptive check to avoid memory exhaustion on very large reports
            if ($prestamos->count() > 1000) {
                return redirect()->back()->with('error', 'No se puede generar un reporte histórico con más de 1000 registros. Por favor, genere el reporte por rangos de fecha.');
            }

            $pdf = PDF::loadView('reportes.pdf', [
                'prestamos' => $prestamos,
                'fecha_inicio' => 'Historial Completo',
                'fecha_fin' => ''
            ]);

            return $pdf->stream('reporte-historico-prestamos.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo generar el reporte histórico en PDF. El error puede deberse a un conjunto de datos demasiado grande o a un problema con la plantilla.');
        }
    }
}

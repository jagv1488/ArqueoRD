<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LogExportController extends Controller
{
    public function export(Site $site)
    {
        $site->load(['user', 'discoveries']);

        // Verificación de seguridad: Solo el dueño o Admin ven datos sensibles en el PDF
        $hasFullAccess = false;
        if (in_array(auth()->user()->role, ['admin', 'ministerio']) || auth()->id() === $site->user_id) {
            $hasFullAccess = true;
        }

        // CORRECCIÓN: Llamamos a 'report' en lugar de 'report.pdf'
        $pdf = Pdf::loadView('report', compact('site', 'hasFullAccess'));

        // Retornar el PDF para descargar
        return $pdf->download('Reporte-ArqueoRD-' . $site->id . '.pdf');
    }
}

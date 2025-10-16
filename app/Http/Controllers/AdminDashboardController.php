<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $ROL_SEMBRADOR = 5;

        // ====== KPIs rápidos (ya los tenías) ======
        $totalCac       = DB::table('cacs')->count();
        $totalCultivos  = DB::table('cultivos')->count();
        $totalCosechas  = DB::table('cosechas')->count();
        $totalSembradores = DB::table('sembradores')->count();
        if ($totalSembradores === 0) {
            $totalSembradores = DB::table('users')->where('role_id', $ROL_SEMBRADOR)->count();
        }
        $avanceProductivo  = $totalCultivos > 0
            ? min(100, (int) round(($totalCosechas / max(1, $totalCultivos)) * 100))
            : 0;

        // ====== Rango últimos 12 meses ======
        $end   = Carbon::now()->startOfMonth();         // ej. 2025-10-01
        $start = (clone $end)->subMonths(11);           // 12 meses atrás

        // Helper de meses formateados "YYYY-MM" -> "Mes YYYY" (para etiquetas)
        $labels = [];
        $cursor = $start->copy();
        while ($cursor <= $end) {
            $labels[] = $cursor->translatedFormat('M Y'); // ej. "oct 2025"
            $cursor->addMonth();
        }

        // ====== Serie: Cosechas por mes (usa created_at) ======
        $rawCosechas = DB::table('cosechas')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') ym, COUNT(*) total")
            ->whereBetween('created_at', [$start, (clone $end)->endOfMonth()])
            ->groupBy('ym')
            ->orderBy('ym')
            ->pluck('total', 'ym')
            ->toArray();

        // Normaliza a 12 posiciones
        $cosechasSeries = [];
        $cursor = $start->copy();
        while ($cursor <= $end) {
            $ym = $cursor->format('Y-m');
            $cosechasSeries[] = $rawCosechas[$ym] ?? 0;
            $cursor->addMonth();
        }

        // ====== Serie: Sembradores por mes ======
        $rawSembradores = DB::table('sembradores')->count() > 0
            ? DB::table('sembradores')
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') ym, COUNT(*) total")
                ->whereBetween('created_at', [$start, (clone $end)->endOfMonth()])
                ->groupBy('ym')
                ->orderBy('ym')
                ->pluck('total', 'ym')
                ->toArray()
            : DB::table('users')
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') ym, COUNT(*) total")
                ->where('role_id', $ROL_SEMBRADOR)
                ->whereBetween('created_at', [$start, (clone $end)->endOfMonth()])
                ->groupBy('ym')
                ->orderBy('ym')
                ->pluck('total', 'ym')
                ->toArray();

        $sembradoresSeries = [];
        $cursor = $start->copy();
        while ($cursor <= $end) {
            $ym = $cursor->format('Y-m');
            $sembradoresSeries[] = $rawSembradores[$ym] ?? 0;
            $cursor->addMonth();
        }

        return view('dashboards.admin', [
            'totalCac'           => $totalCac,
            'totalCultivos'      => $totalCultivos,
            'totalCosechas'      => $totalCosechas,
            'totalSembradores'   => $totalSembradores,
            'avanceProductivo'   => $avanceProductivo,
            // Gráficas
            'chartLabels'        => $labels,               // e.g. ["nov 2024", ...]
            'cosechasSeries'     => $cosechasSeries,       // 12 valores
            'sembradoresSeries'  => $sembradoresSeries,    // 12 valores
        ]);
    }
}

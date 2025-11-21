<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $ROL_TECNICO   = 4;
        $ROL_SEMBRADOR = 5;

        // ===== KPIs =====
        $totalCac         = DB::table('cacs')->count();
        $totalCultivos    = DB::table('cultivos')->count();
        $totalCosechas    = DB::table('cosechas')->count();
        $totalTecnicos    = DB::table('users')->where('role_id', $ROL_TECNICO)->count();

        $totalSembradores = DB::table('sembradores')->count();
        if ($totalSembradores === 0) {
            $totalSembradores = DB::table('users')->where('role_id', $ROL_SEMBRADOR)->count();
        }

        $avanceProductivo = $totalCultivos > 0
            ? min(100, (int) round(($totalCosechas / max(1, $totalCultivos)) * 100))
            : 0;

        // ===== Últimos 12 meses =====
        $end   = Carbon::now()->startOfMonth();
        $start = (clone $end)->subMonths(11);

        // Etiquetas "M Y" (ej. "oct 2025")
        $labels = [];
        $cursor = $start->copy();
        while ($cursor <= $end) {
            $labels[] = $cursor->translatedFormat('M Y');
            $cursor->addMonth();
        }

        // Cosechas por mes
        $rawCosechas = DB::table('cosechas')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') ym, COUNT(*) total")
            ->whereBetween('created_at', [$start, (clone $end)->endOfMonth()])
            ->groupBy('ym')->orderBy('ym')
            ->pluck('total', 'ym')->toArray();

        $cosechasSeries = [];
        $cursor = $start->copy();
        while ($cursor <= $end) {
            $ym = $cursor->format('Y-m');
            $cosechasSeries[] = $rawCosechas[$ym] ?? 0;
            $cursor->addMonth();
        }

        // Sembradores por mes (prefiere tabla sembradores; si está vacía, users con role_id=5)
        if (DB::table('sembradores')->count() > 0) {
            $rawSembradores = DB::table('sembradores')
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') ym, COUNT(*) total")
                ->whereBetween('created_at', [$start, (clone $end)->endOfMonth()])
                ->groupBy('ym')->orderBy('ym')
                ->pluck('total', 'ym')->toArray();
        } else {
            $rawSembradores = DB::table('users')
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') ym, COUNT(*) total")
                ->where('role_id', $ROL_SEMBRADOR)
                ->whereBetween('created_at', [$start, (clone $end)->endOfMonth()])
                ->groupBy('ym')->orderBy('ym')
                ->pluck('total', 'ym')->toArray();
        }

        $sembradoresSeries = [];
        $cursor = $start->copy();
        while ($cursor <= $end) {
            $ym = $cursor->format('Y-m');
            $sembradoresSeries[] = $rawSembradores[$ym] ?? 0;
            $cursor->addMonth();
        }

        // ===== CACs para el mapa (JOIN municipio/estado) =====
        $cacs = DB::table('cacs')
            ->leftJoin('municipios', 'municipios.id', '=', 'cacs.municipio_id')
            ->leftJoin('estados', 'estados.id', '=', 'municipios.estado_id')
            ->select(
                'cacs.id',
                'cacs.nombre',
                'cacs.latitud',
                'cacs.longitud',
                DB::raw('municipios.nombre as municipio'),
                DB::raw('estados.nombre as estado')
            )
            ->whereNotNull('cacs.latitud')
            ->whereNotNull('cacs.longitud')
            ->get();

        // ===== ÚNICO return =====
        return view('dashboards.admin', [
            'totalTecnicos'      => $totalTecnicos,
            'totalSembradores'   => $totalSembradores,
            'totalCac'           => $totalCac,
            'totalCultivos'      => $totalCultivos,
            'totalCosechas'      => $totalCosechas,
            'avanceProductivo'   => $avanceProductivo,
            'chartLabels'        => $labels,
            'cosechasSeries'     => $cosechasSeries,
            'sembradoresSeries'  => $sembradoresSeries,
            'cacs'               => $cacs,
        ]);
    }
}

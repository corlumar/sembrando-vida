@extends('layouts.adminlte')

@section('content')
  {{-- 🔹 Aquí van tus tarjetas y gráficas, SIN <html> ni <body> --}}
  <div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{{ number_format($totalTecnicos ?? 0) }}</h3>
          <p>Técnicos</p>
        </div>
        <div class="icon"><i class="fas fa-user-tie"></i></div>
        <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ number_format($totalSembradores ?? 0) }}</h3>
          <p>Sembradores</p>
        </div>
        <div class="icon"><i class="fas fa-users"></i></div>
        <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ number_format($totalCac ?? 0) }}</h3>
          <p>CAC</p>
        </div>
        <div class="icon"><i class="fas fa-warehouse"></i></div>
        <a href="#" class="small-box-footer text-dark">Ver más <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ ($avanceProductivo ?? 0) }}%</h3>
          <p>Avance Productivo</p>
        </div>
        <div class="icon"><i class="fas fa-seedling"></i></div>
        <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  {{-- Gráficas (si ya pusimos los datos desde el controlador) --}}
  <div class="row">
    <div class="col-lg-6 col-12">
      <div class="card card-outline card-primary">
        <div class="card-header"><h3 class="card-title">Cosechas por mes</h3></div>
        <div class="card-body" style="height:320px;">
          <canvas id="chartCosechas"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-12">
      <div class="card card-outline card-success">
        <div class="card-header"><h3 class="card-title">Sembradores por mes</h3></div>
        <div class="card-body" style="height:320px;">
          <canvas id="chartSembradores"></canvas>
        </div>
      </div>
    </div>
  </div>

  {{-- CDN Chart.js (si no lo pusiste en el layout) --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <script>
    const labels = @json($chartLabels ?? []);
    const cosechasData = @json($cosechasSeries ?? []);
    const sembradoresData = @json($sembradoresSeries ?? []);

    if (document.getElementById('chartCosechas')) {
      new Chart(document.getElementById('chartCosechas'), {
        type: 'line',
        data: { labels, datasets: [{ label: 'Cosechas', data: cosechasData, tension: .25, fill: true }] },
        options: { responsive: true, maintainAspectRatio: false }
      });
    }
    if (document.getElementById('chartSembradores')) {
      new Chart(document.getElementById('chartSembradores'), {
        type: 'bar',
        data: { labels, datasets: [{ label: 'Sembradores', data: sembradoresData }] },
        options: { responsive: true, maintainAspectRatio: false }
      });
    }<div class="row">
  <div class="col-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Mapa de CACs</h3>
      </div>
      <div class="card-body p-0">
        <div id="mapCAC" style="height: 480px; width: 100%;"></div>
      </div>
    </div>
  </div>
</div>

<script>
  // Datos desde el servidor
  const cacs = @json($cacs ?? []);

  // Coordenadas de centro (México aprox). Ajusta si quieres centrar en tu estado.
  const center = [23.6345, -102.5528];
  const map = L.map('mapCAC').setView(center, 5);

  // Capa base (OSM)
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; OpenStreetMap'
  }).addTo(map);

  // Icono verde para CAC (opcional)
  const greenIcon = L.icon({
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -28],
    shadowSize: [41, 41]
  });

  // Poner marcadores
  cacs.forEach(c => {
    // Ajusta claves si usaste 'lat'/'lng'
    if (!c.latitud || !c.longitud) return;
    const marker = L.marker([parseFloat(c.latitud), parseFloat(c.longitud)], { icon: greenIcon })
      .addTo(map);

    const title = c.nombre ? `<strong>${c.nombre}</strong><br>` : '';
    const lugar = [c.municipio, c.estado].filter(Boolean).join(', ');
    marker.bindPopup(`${title}${lugar}`);
  });

  // Si hay puntos, ajusta el zoom al grupo
  if (cacs.length) {
    const pts = cacs
      .filter(c => c.latitud && c.longitud)
      .map(c => [parseFloat(c.latitud), parseFloat(c.longitud)]);
    if (pts.length) map.fitBounds(pts, { padding: [30,30] });
  }
</script>

  </script>
@endsection

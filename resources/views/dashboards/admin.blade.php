<div class="content-wrapper">
  <section class="content pt-3">
    <div class="container-fluid">

      <div class="row">
        <!-- Técnicos -->
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

        <!-- Sembradores -->
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

        <!-- CAC -->
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

        <!-- Avance -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $avanceProductivo ?? 0 }}%</h3>
              <p>Avance Productivo</p>
            </div>
            <div class="icon"><i class="fas fa-seedling"></i></div>
            <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <!-- Segunda fila: Cultivos / Cosechas -->
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ number_format($totalCultivos ?? 0) }}</h3>
              <p>Cultivos</p>
            </div>
            <div class="icon"><i class="fas fa-leaf"></i></div>
            <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{ number_format($totalCosechas ?? 0) }}</h3>
              <p>Cosechas</p>
            </div>
            <div class="icon"><i class="fas fa-shopping-basket"></i></div>
            <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <div class="row">
  <div class="col-lg-6 col-12">
    <div class="card card-outline card-primary">
      <div class="card-header"><h3 class="card-title">Cosechas por mes</h3></div>
      <div class="card-body" style="height:280px">
        <canvas id="chartCosechas"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-12">
    <div class="card card-outline card-success">
      <div class="card-header"><h3 class="card-title">Sembradores por mes</h3></div>
      <div class="card-body" style="height:280px">
        <canvas id="chartSembradores"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
  const labels = @json($chartLabels ?? []);
  const cosechasData = @json($cosechasSeries ?? []);
  const sembradoresData = @json($sembradoresSeries ?? []);

  // Línea: Cosechas
  new Chart(document.getElementById('chartCosechas'), {
    type: 'line',
    data: { labels, datasets: [{ label: 'Cosechas', data: cosechasData, tension: 0.25, fill: true }]},
    options: { responsive: true, maintainAspectRatio: false }
  });

  // Barras: Sembradores
  new Chart(document.getElementById('chartSembradores'), {
    type: 'bar',
    data: { labels, datasets: [{ label: 'Sembradores', data: sembradoresData }]},
    options: { responsive: true, maintainAspectRatio: false }
  });
</script>

</div>

@extends('layouts.wowdash.core')
@section('body')
@include('topik.sidebar')
<main class="dashboard-main">
    @include('topik.topbar')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Dashboard</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('topik.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
            </ul>
        </div>

        <div class="row gy-4">
            <div class="col-xxl-8">
                <div class="row gy-4">
                    <div class="col-xxl-4 col-sm-6">
                        <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-6">
                            <div class="card-body p-0">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                    <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-cyan text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="ic:round-topic" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Total Topik</span>
                                        <h6 class="fw-semibold">{{ $totalTopik }}</h6>
                                    </div>
                                    </div>

                                    <div id="total-profit-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                </div>
                                {{-- <p class="text-sm mb-0">Increase by  <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+$15k</span> this week</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-sm-6">
                        <div class="card p-3 shadow-2 radius-8 border input-form-light h-100 bg-gradient-end-6">
                            <div class="card-body p-0">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">

                                    <div class="d-flex align-items-center gap-2">
                                    <span class="mb-0 w-48-px h-48-px bg-cyan text-white flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle h6">
                                        <iconify-icon icon="ic:outline-dataset" class="icon"></iconify-icon>
                                    </span>
                                    <div>
                                        <span class="mb-2 fw-medium text-secondary-light text-sm">Total Dataset</span>
                                        <h6 class="fw-semibold">{{ $totalDataset }}</h6>
                                    </div>
                                    </div>

                                    <div id="total-profit-chart" class="remove-tooltip-title rounded-tooltip-value"></div>
                                </div>
                                {{-- <p class="text-sm mb-0">Increase by  <span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">+$15k</span> this week</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8">
                <!-- Earning Static start -->
                <div class="col-xxl-8">
                    <div class="card h-100 radius-8 border-0">
                    <div class="card-body p-24">
                        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                            <div>
                                <h6 class="mb-2 fw-bold text-lg">Data Topik</h6>
                                <span class="text-sm fw-medium text-secondary-light">Dihitung berdasarkan dataset</span>
                            </div>

                        </div>

                        <div id="barChart" class="barChart"></div>
                    </div>
                    </div>
                </div>
                <!-- Earning Static End -->
            </div>
        </div>
    </div>
</main>
@endsection
@section('scripts')
<script>
    @php
        $dataTopik = [];
        foreach($topikAll as $topik){
            $dataTopik[] = [
                'x' => $topik->topik,
                'y' => $topik->dataset->count(),
            ];
        }
        $topiks = [];
        foreach($topikAll as $topikh){
            $topiks[] = $topikh->topik;
        }
    @endphp
    var options = {
      series: [{
          name: "Data Topik",
          data: @json($dataTopik)
      }],
      chart: {
          type: 'bar',
          height: 310,
          toolbar: {
              show: false
          }
      },
      plotOptions: {
          bar: {
              borderRadius: 4,
              horizontal: false,
              columnWidth: '23%',
              endingShape: 'rounded',
          }
      },
      dataLabels: {
          enabled: false
      },
      fill: {
          type: 'gradient',
          colors: ['#487FFF'], // Set the starting color (top color) here
          gradient: {
              shade: 'light', // Gradient shading type
              type: 'vertical',  // Gradient direction (vertical)
              shadeIntensity: 0.5, // Intensity of the gradient shading
              gradientToColors: ['#487FFF'], // Bottom gradient color (with transparency)
              inverseColors: false, // Do not invert colors
              opacityFrom: 1, // Starting opacity
              opacityTo: 1,  // Ending opacity
              stops: [0, 100],
          },
      },
      grid: {
          show: true,
          borderColor: '#D1D5DB',
          strokeDashArray: 4, // Use a number for dashed style
          position: 'back',
      },
      xaxis: {
          type: 'category',
          categories: @json($topiks)
      },
      yaxis: {
          labels: {
              formatter: function (value) {
                  return value;
              }
          }
      },
      tooltip: {
          y: {
              formatter: function (value) {
                  return value / 1000 + 'k';
              }
          }
      }
    };

    var chart = new ApexCharts(document.querySelector("#barChart"), options);
    chart.render();
</script>
@endsection

@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="text-center mb-4">
        <h2 class="text-primary">Selamat Datang Kembali</h2>
        <h5>Sistem Informasi Akseptor KB</h5>
        <hr>
    </div>
    {{-- dashboard admin --}}
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Akseptor</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="myAreaChart" width="1220" height="640" class="chartjs-render-monitor"
                            style="display: block; height: 320px; width: 610px;"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <hr>
    @if (Auth::user()->role == 'Admin')
        <div class="row justify-content-center">
            <!-- Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-warning shadow h-100 py-2 text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-boldtext-uppercase mb-1">{{ __('Admin') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold ">{{ $widget['admin'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success shadow h-100 py-2 text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1">{{ __('Operator') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold">{{ $widget['operator'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-primary text-white shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                    {{ __('Penanggung Jawab') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold ">{{ $widget['penanggungjawab'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-secondary shadow h-100 py-2 text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    {{ __('Puskesmas') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold ">{{ $widget['puskesmas'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hospital fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-danger text-white shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    {{ __('Alat Kontrasepsi') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold ">{{ $widget['alat'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-toolbox fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @elseif(Auth::user()->role == 'Operator')
    @endif
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch data from the server
            $.ajax({
                url: '{{ url('akseptor_chart') }}',
                method: 'GET',
                success: function(data) {
                    const ctx = document.getElementById('myAreaChart').getContext('2d');

                    // Create the area chart
                    const myAreaChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.months.map(month => {
                                return new Date(0, month - 1).toLocaleString(
                                    'default', {
                                        month: 'long'
                                    });
                            }),
                            datasets: [{
                                label: 'Data Akseptor',
                                data: data.counts,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                tooltip: {
                                    enabled: true
                                }
                            }
                        }
                    });
                },
                error: function(err) {
                    console.error('Error fetching data', err);
                }
            });
        });
    </script>
@endpush

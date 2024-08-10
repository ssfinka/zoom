@extends('layout.admin')

@section('title', 'Laporan Bulanan')

@section('css')
    <!-- Custom CSS for laporan bulanan -->
    <style>
        .chart-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            margin: auto;
        }

        #myChart {
            display: block;
            width: 100%;
            height: 250px;
            border-radius: 8px;
        }

        .date-range {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .date-range label {
            margin-right: 5px;
        }

        .date-range input[type="date"] {
            height: calc(1.5em + 0.75rem + 2px);
            font-size: 1rem;
            padding: 0.375rem 0.75rem;
            max-width: 150px;
        }

        .date-range button {
            height: calc(1.5em + 0.75rem + 2px);
            font-size: 1rem;
            padding: 0.375rem 0.75rem;
            max-width: 100px;
        }

        .custom-button {
            height: calc(1.5em + 0.75rem + 2px);
            font-size: 1rem;
            line-height: 1.5;
        }

        .chart-header {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan Bulanan</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Laporan Bulanan</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="chart-header">
                    Laporan Persetujuan dan Penolakan Link Zoom
                </div>

                <!-- Chart Container -->
                <div class="chart-container">
                    <!-- Chart Header -->
                    <div class="w-100">
                        <div id="report" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>

                <!-- Date Range Selector -->
                <div class="date-range">
                    <label for="startDate">Tanggal Mulai</label>
                    <input type="date" id="startDate" name="startDate" class="form-control">
                    <label for="endDate">Tanggal Akhir</label>
                    <input type="date" id="endDate" name="endDate" class="form-control">
                    <button id="applyRange" class="btn btn-default custom-button">Terapkan</button>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <!-- Include Moment.js -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Chart.js Moment Adapter -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script> --}}
    <script>
        $(function () {

            // Get the current date
            var today = new Date();
            // Get the first date of the month
            var firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
            var firstDayFormatted = firstDay.getFullYear() + '-' +
                                    String(firstDay.getMonth() + 1).padStart(2, '0') + '-' +
                                    String(firstDay.getDate()).padStart(2, '0');

            // Get the last date of the month
            var lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            var lastDayFormatted = lastDay.getFullYear() + '-' +
                                    String(lastDay.getMonth() + 1).padStart(2, '0') + '-' +
                                    String(lastDay.getDate()).padStart(2, '0');

            getChart(firstDayFormatted, lastDayFormatted);

            function getChart(startDate, endDate) {
                var start = startDate ? startDate : firstDayFormatted;
                var end = endDate ? endDate : endDayFormatted;
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.laporan-bulanan.chart') }}",
                    data: {
                        start: start,
                        end: end,
                    },
                    cache: false,
                    success: function (response) {
                        var options = {
                            series: [{
                                    name: "Total Disetujui",
                                    data: response.approved
                                },
                                {
                                    name: "Total Ditolak",
                                    data: response.rejected
                                }
                            ],
                            chart: {
                                height: 350,
                                type: 'line',
                                dropShadow: {
                                    enabled: true,
                                    color: '#000',
                                    top: 18,
                                    left: 7,
                                    blur: 10,
                                    opacity: 0.2
                                },
                                zoom: {
                                    enabled: false
                                },
                                toolbar: {
                                    show: false
                                }
                            },
                            colors: ['#77B6EA', '#545454'],
                            dataLabels: {
                                enabled: true,
                            },
                            stroke: {
                                curve: 'smooth'
                            },
                            title: {
                                text: 'Periode: '+response.labels[0]+' - '+response.labels[response.labels.length - 1],
                                align: 'left'
                            },
                            grid: {
                                borderColor: '#e7e7e7',
                                row: {
                                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                    opacity: 0.5
                                },
                            },
                            markers: {
                                size: 1
                            },
                            xaxis: {
                                categories: response.labels,
                                title: {
                                    text: 'Tanggal'
                                }
                            },
                            yaxis: {
                                title: {
                                    text: 'Total'
                                },
                            },
                            legend: {
                                position: 'top',
                                horizontalAlign: 'right',
                                floating: true,
                                offsetY: -25,
                                offsetX: -5
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#report"), options);
                        chart.render();
                        chart.updateSeries([{
                            name: "Total Disetujui",
                            data: response.approved
                        },
                        {
                            name: "Total Ditolak",
                            data: response.rejected
                        }]);
                    }
                });
            }

            $('#applyRange').on('click', function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                getChart(startDate, endDate);
            });

        });
    </script>
@endsection

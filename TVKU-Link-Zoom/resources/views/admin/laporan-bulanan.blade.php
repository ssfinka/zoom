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
        <canvas id="myChart"></canvas>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('myChart').getContext('2d');

    var dynamicLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
    var approvedData = [10, 15, 20, 25, 30, 35, 40]; // Data untuk peminjaman yang disetujui
    var rejectedData = [5, 10, 15, 20, 25, 30, 35]; // Data untuk peminjaman yang ditolak

    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: dynamicLabels,
        datasets: [{
            label: 'Total Disetujui',
            data: approvedData,
            fill: false,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
          },
          {
            label: 'Total Ditolak',
            data: rejectedData,
            fill: false,
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            tension: 0.1
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
</script>
@endsection
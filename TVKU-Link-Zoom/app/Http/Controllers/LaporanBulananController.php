<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanBulananController extends Controller
{
    public function index()
    {
        return view('admin.laporan-bulanan');
    }

    public function chart(Request $request)
    {

        $startDate = Carbon::parse($request->start);
        $endDate = Carbon::parse($request->end);

        $labels = [];
        $approvedData = [];
        $rejectedData = [];

        while ($startDate->lte($endDate)) {
            $date = $startDate->format('Y-m-d');
            $dateFormated = $startDate->format('d/m/Y');
            $labels[] = $dateFormated;

            // Retrieve data filtered by date range
            $approvedCount = Peminjaman::whereDate('waktu_peminjaman', $date)
                    ->where('status', 'disetujui')
                    ->count();

            $rejectedCount = Peminjaman::whereDate('waktu_peminjaman', $date)
                    ->where('status', 'ditolak')
                    ->count();

            $approvedData[] = $approvedCount;
            $rejectedData[] = $rejectedCount;

            $startDate->addDay();
        }

        $data = [
            'labels'    => $labels,
            'approved'  => $approvedData,
            'rejected'  => $rejectedData,
        ];

        return response()->json($data);
    }
}

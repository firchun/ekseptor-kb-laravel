<?php

namespace App\Http\Controllers;

use App\Models\AlatKontrasepsi;
use App\Models\Ekseptor;
use App\Models\Puskesmas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');
        $admin = User::where('role', 'Admin')->count();
        $operator = User::where('role', 'Operator')->count();
        $pj = User::where('role', 'PJ-KB')->count();

        $puskesmas = Puskesmas::count();
        $alat = AlatKontrasepsi::count();

        $widget = [
            'admin' => $admin,
            'operator' => $operator,
            'penanggungjawab' => $pj,
            'puskesmas' => $puskesmas,
            'alat' => $alat,
        ];

        return view('home', compact('widget'));
    }
    public function homepage()
    {
        return view('welcome');
    }
    public function detail($kode_alat)
    {
        $alat = AlatKontrasepsi::where('kode_alat', $kode_alat)->first();
        $data = [
            'title' => $alat->nama_alat,
            'alat' => $alat
        ];
        return view('detail', $data);
    }
    public function akseptor_chart()
    {
        // Get the current month
        $currentMonth = now()->month;

        // Generate the last 6 months
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $months[] = ($currentMonth - $i - 1 + 12) % 12 + 1; // Month index (1-12)
        }

        // Prepare a collection to hold counts for the last 6 months
        $counts = array_fill(0, 6, 0);

        // Fetch the data grouped by month
        $data = Ekseptor::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month');

        if (Auth::user()->role != 'Admin') {
            $data->where('id_puskesmas', Auth::user()->id_puskesmas);
        }

        $data = $data->get();

        // Map the results to the corresponding month
        foreach ($data as $item) {
            // Check if the month is in the last 6 months
            $index = array_search($item->month, $months);
            if ($index !== false) {
                $counts[$index] = $item->count; // Set the count for the corresponding month
            }
        }

        return response()->json([
            'months' => $months,
            'counts' => $counts,
        ]);
    }
}
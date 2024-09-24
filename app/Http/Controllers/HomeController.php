<?php

namespace App\Http\Controllers;

use App\Models\AlatKontrasepsi;
use App\Models\User;
use Illuminate\Http\Request;

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
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
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
}
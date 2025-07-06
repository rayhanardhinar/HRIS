<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GajiKaryawanController extends Controller
{
    public function index()
    {
        return view('karyawan.gaji.index');
    }
}

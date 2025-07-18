<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Karyawan\{
    GajiKaryawanController,
};
use App\Http\Controllers\Admin\{
    PekerjaanController,
    GajiController,
    CutiController,
    LemburController,
    PresensiController,
    KaryawanController,
    DepartmentController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth'])->get('/dashboard', function () {
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return view('admin.dashboard');
    } elseif ($user->hasRole('karyawan')) {
        return view('karyawan.dashboard');
    } elseif ($user->hasRole('manager')) {
        return view('manager.dashboard');
    }

    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/user', UserController::class)->except(['show']);
});

Route::middleware(['auth', 'role:admin|manager'])->group(function () {
    // Pekerjaan
    Route::resource('/pekerjaan', PekerjaanController::class)->except(['show']);

    // Gaji
    Route::resource('/gaji', GajiController::class)->except(['show']);

    // Cuti
    Route::resource('/cuti', CutiController::class)->except(['show']);

    // Lembur
    Route::resource('/lembur', LemburController::class)->except(['show']);

    // Presensi
    Route::resource('/presensi', PresensiController::class)->except(['show']);

    // Karyawan
    Route::resource('/karyawan', KaryawanController::class)->except(['show']);

    // Departemen
    Route::resource('/department', DepartmentController::class)->except(['show']);
});

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/gaji', [GajiKaryawanController::class, 'index'])->name('gaji.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Cek Role function
use App\Models\User;

Route::get('/cek-role', function () {
    $users = User::with('roles')->get()->map(function ($user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->roles->pluck('name')->toArray(), // ambil hanya nama rolenya
        ];
    });

    dd($users);
});

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

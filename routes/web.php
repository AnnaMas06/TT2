<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\UserController;

Route::get('/admin/users', [UserController::class, 'index'])
    ->name('admin.users.index')
    ->middleware(['auth', 'role:admin']);

Route::patch('/admin/users/{user}/role', [UserController::class, 'updateRole'])
    ->name('admin.users.updateRole')
    ->middleware(['auth', 'role:admin']);

Route::get('/equipment-search', [EquipmentController::class, 'search'])
    ->name('equipment.search');

Route::get('/language/{locale}', function ($locale) {

    if (!in_array($locale, ['lv', 'en'])) {
        abort(400);
    }

    session(['locale' => $locale]);

    return back();

})->name('language.switch');

Route::resource('categories', CategoryController::class)
    ->middleware(['auth', 'role:admin']);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/admin-test', function () {
    return 'Admin access granted';
})->middleware(['auth', 'role:admin']);

Route::resource('equipment', EquipmentController::class)
    ->middleware(['auth', 'role:admin']);

Route::resource('reservations', ReservationController::class)
    ->middleware(['auth']);

Route::patch('/reservations/{reservation}/approve', [ReservationController::class, 'approve'])
    ->name('reservations.approve')
    ->middleware(['auth', 'role:admin,staff']);

Route::patch('/reservations/{reservation}/reject', [ReservationController::class, 'reject'])
    ->name('reservations.reject')
    ->middleware(['auth', 'role:admin,staff']);


require __DIR__.'/auth.php';

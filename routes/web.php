<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DelegateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return Redirect::to('/dashboard');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->prefix('delegates')->group(function () {
    Route::get('/', [DelegateController::class, 'index'])->name('delegates.index');
    Route::get('/room/print', [DelegateController::class, 'room_print'])->name('delegates.room_print');
    Route::middleware(['role:admin'])->get('/mark_paid', [DelegateController::class, 'mark_paid'])->name('delegates.mark_paid');
    Route::middleware(['role:admin'])->get('/mark_unpaid', [DelegateController::class, 'mark_unpaid'])->name('delegates.mark_unpaid');
    Route::get('/send_confirmation_emails', [DelegateController::class, 'send_confirmation_mail'])->name('delegates.send_confirmation_emails');
    Route::get('/send_payment_emails', [DelegateController::class, 'send_payment_mail'])->name('delegates.send_payment_emails');
    Route::get('/{id}/read_qr_code', [DelegateController::class, 'read_qr_code'])->name('read_qr_code');
    Route::middleware(['role:admin'])->get('/delete', [DelegateController::class, 'delete_delegate'])->name('delegates.delete');
    Route::get('/edit', [DelegateController::class, 'edit_delegate'])->name('delegates.edit');
    Route::post('/{id}/update', [DelegateController::class, 'update'])->name('delegates.update');
    Route::get('/profile', [DelegateController::class, 'get_profile'])->name('delegates.profile');
    Route::get('/mark_checked_in', [DelegateController::class, 'mark_checked_in'])->name('delegates.mark_checked_in');
    Route::middleware(['role:admin'])->get('/mark_unchecked_in', [DelegateController::class, 'mark_unchecked_in'])->name('delegates.mark_unchecked_in');
});
Route::middleware(['auth:sanctum', 'verified'])->prefix('export')->group(function () {
    Route::get('index', function () {
        return view('export.index');
    })->name('exports.index');
    Route::get('paid', [ExportController::class, 'export_paid'])->name('exports.export_paid');
    Route::get('unpaid', [ExportController::class, 'export_unpaid'])->name('exports.export_unpaid');
    Route::get('registered', [ExportController::class, 'export_registered'])->name('exports.export_registered');
});
Route::middleware(['auth:sanctum', 'verified'])->prefix('analytics')->group(function () {
    Route::get('index', [AnalyticsController::class, 'index'])->name('analytics.index');
});
Route::get('book/{event}', function ($event) {
    return view('booking', compact('event'));
})->name('book');

Route::get('pay/{id}', function ($id) {
    $delegate = DB::table('delegates')->where('id', '=', $id)->get()->first();
    $payment = DB::table('payment')->where('user_id', '=', $id)->get()->first();
    if ($payment == null) {
        return view('payment', compact('delegate'));
    }
    abort(404);
})->name('payment');

Route::post('book/{event}/save', [EventController::class, 'register'])->name('event.register');
Route::post('pay/{id}/save', [EventController::class, 'pay'])->name('event.payment');



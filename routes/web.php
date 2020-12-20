<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DelegateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\RoomController;
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
    Route::middleware(['role:admin'])->get('/mark_paid', [DelegateController::class, 'mark_paid'])->name('delegates.mark_paid');
    Route::middleware(['role:admin'])->get('/mark_unpaid', [DelegateController::class, 'mark_unpaid'])->name('delegates.mark_unpaid');
    Route::get('/send_confirmation_emails', [DelegateController::class, 'send_confirmation_mail'])->name('delegates.send_confirmation_emails');
    Route::get('/send_payment_emails', [DelegateController::class, 'send_payment_mail'])->name('delegates.send_payment_emails');
    Route::get('/{id}/read_qr_code', [DelegateController::class, 'read_qr_code'])->name('read_qr_code');
    Route::middleware(['role:admin'])->get('/delete', [DelegateController::class, 'delete_delegate'])->name('delegates.delete');
    Route::middleware(['role:admin'])->get('/edit', [DelegateController::class, 'edit_delegate'])->name('delegates.edit');
    Route::middleware(['role:admin'])->post('/{id}/update', [DelegateController::class, 'update'])->name('delegates.update');
    Route::get('/profile', [DelegateController::class, 'get_profile'])->name('delegates.profile');
    Route::get('/mark_checked_in', [DelegateController::class, 'mark_checked_in'])->name('delegates.mark_checked_in');
    Route::middleware(['role:admin'])->get('/mark_unchecked_in', [DelegateController::class, 'mark_unchecked_in'])->name('delegates.mark_unchecked_in');
    Route::prefix('/rooms')->group(function () {
        Route::get('/{id}/print', [RoomController::class, 'print_room'])->name('rooms.print');
        Route::get('index', function () {
            $rooms = DB::table('rooms')->get()->all();
            return view('rooms.index', compact('rooms'));
        })->name('rooms.index');
        Route::get('{id}/edit_room_number', [RoomController::class, 'edit_room_number'])->name('rooms.edit_room_number');
        Route::get('{id}/view_room', [RoomController::class, 'view_room'])->name('rooms.view_room');
        Route::get('create', [RoomController::class, 'create_room'])->name('rooms.create_room');
        Route::get('{id}/mark_check_out', [RoomController::class, 'mark_check_out'])->name('rooms.check_out');
        Route::get('{id}/mark_room_check_out', [RoomController::class, 'mark_room'])->name('rooms.mark_room');
    });
});
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->prefix('export')->group(function () {
    Route::get('index', function () {
        return view('export.index');
    })->name('exports.index');
    Route::get('paid', [ExportController::class, 'export_paid'])->name('exports.export_paid');
    Route::get('unpaid', [ExportController::class, 'export_unpaid'])->name('exports.export_unpaid');
    Route::get('registered', [ExportController::class, 'export_registered'])->name('exports.export_registered');
});
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->prefix('imports')->group(function () {
    Route::get('index', function () {
        $delegates = DB::table('accepted_delegates')->where('deleted', '=', 0)->get()->all();
        return view('imports.index', compact('delegates'));
    })->name('imports.index');
    Route::post('upload', [ImportController::class, 'import'])->name('imports.import');
    Route::get('send_registration_emails', [ImportController::class, 'send_emails'])->name('imports.send_registration_emails');
    Route::get('delete', [ImportController::class, 'delete'])->name('imports.delete');
    Route::get('edit', [ImportController::class, 'edit'])->name('imports.edit');
    Route::post('{id}/update', [ImportController::class, 'update'])->name('imports.update');
});
Route::middleware(['auth:sanctum', 'verified'])->prefix('analytics')->group(function () {
    Route::get('index', [AnalyticsController::class, 'index'])->name('analytics.index');
});

Route::get('book/{event}', function ($event) {
    return view('booking', compact('event'));
})->name('book');
Route::get('book/{event}/{id}', function ($event, $id) {
    $delegate = DB::table('accepted_delegates')->where('id', '=', $id)->get()->first();
    $data = ['event' => $event, 'delegate' => $delegate];
    return view('booking', compact('data'));

})->name('book-id');

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
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->get('/create_account/{role}', function ($role) {
    return view('auth.register', compact('role'));
})->name('create_account');
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->post('/create_account/save',[Controller::class,'create_user'])->name('save_account');


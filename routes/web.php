<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;

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

Route::get('/', [CalendarController::class, 'index'])->name('calendar.default');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');

Route::patch('/calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
Route::get('/calendar/viewDetails/{bookings_id}', [CalendarController::class, 'viewDetails'])->name('calendar.viewDetails');

Route::get('/viewDetails/{bookings_id}', [CalendarController::class, 'editDetails'])->name('viewDetails.editDetails');
Route::delete('/viewDetails/{id}', [CalendarController::class, 'deleteBooking'])->name('viewDetails.deleteBooking');


Route::patch('/viewDetails/{bookings_id}/update', [CalendarController::class, 'updateDetails'])->name('viewDetails.updateDetails');


Route::get('/customerList', [CalendarController::class, 'customerList'])->name('customerList');
Route::get('/customerList/search', [CalendarController::class, 'search'])->name('customer.search');


// Packages
Route::get('/create-package', function () {
    return view('create-package');
});
Route::get('/archived-package', [CalendarController::class, 'archivedPackages'])->name('archivedPackages');
Route::post('/save-package', [CalendarController::class,'createPackage'])->name('save-package');
Route::get('/edit-package/{id}', [CalendarController::class,'viewPackageById'])->name('edit-package');
Route::get('/packages', [CalendarController::class, 'packages'])->name('packages');

Route::patch('/saveUpdateTicket/{id}', [CalendarController::class, 'updatePackage'])->name('saveUpdateTicket');

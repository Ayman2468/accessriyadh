<?php

use App\Helpers\AppHelpers;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\ApplicationRequest;
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
Route::get("locale/{locale}", [HomeController::class, "changeLocale"])->name("changeLocale");
Route::get("application-export/{id}", function ($id) {
    $application = ApplicationRequest::find($id);
    if(!empty($application)){
    if($application->complianceScore < 60) $application->update(['is_applied'=>0]);
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.application', ['application'=>$application]);
    return $pdf->download('application-'.$application->id.'.pdf');
    }else{
        return response()->json(['message'=>'Not Found']);
    }
});
Route::get('/lang-{locale}.js', [HomeController::class, "getLocales"]);

Route::get('/', function () {
    return view('layouts.app');
})->middleware('localization');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/audit/{any}', function () {
    return view('layouts.app');
})->where('any', '.*')->middleware('localization');
Route::get('/benefits', function () {
    return view('layouts.app');
})->middleware('localization');
Route::get('/how-it-works', function () {
    return view('layouts.app');
})->middleware('localization');
Route::get('/learn', function () {
    return view('layouts.app');
})->middleware('localization');
Route::get('/admin/UsersIndex', function () {
    return view('admin.layouts.app');
})->where('any', '.*')->middleware(['auth', 'localization','admin']);
Route::get('/admin', function () {
    return redirect('admin/home');
})->middleware(['auth', 'localization','admin']);
Route::get('/admin/{any}', function () {
    return view('admin.layouts.app');
})->where('any', '.*')->middleware(['auth', 'localization','admin']);

require __DIR__ . '/auth.php';

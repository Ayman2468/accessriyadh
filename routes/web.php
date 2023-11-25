<?php

use App\Helpers\AppHelpers;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\ApplicationRequest;
use App\Models\ApplicationRequestAnswer;
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
    app()->setLocale(request()->locale);
    $application = ApplicationRequest::find($id);
    if(!empty($application)){
        $application->answers = ApplicationRequestAnswer::join('questions','application_request_answers.question_id','=','questions.id')
        ->join('building_type_questions','building_type_questions.question_id','=','questions.id')
        ->where('application_request_id',$application->id)->where('building_type_questions.building_type_id',$application->building_type_id)->orderBy('building_type_questions.order')->get();
        if($application->compliance_score < 50) $application->update(['is_applied'=>0]);
        foreach($application->answers as $ans){
            if(!is_numeric($ans->answer)){
                foreach(json_decode($ans->answers) as $an){
                    if($an->en == $ans->answer) $ans->answer_ar = $an->ar;
                    if(str_contains($ans->answer,',') && str_contains($ans->answer,$an->en)){
                        if(!isset($ans->answer_ar)) $ans->answer_ar = '';
                        if(!empty($ans->answer_ar)) $ans->answer_ar = $ans->answer_ar.','.$an->ar;
                        else $ans->answer_ar = $ans->answer_ar.$an->ar;
                    }
                }
            }else{
                $ans->answer_ar = $ans->answer;
            }
        }
        //$pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.application', ['application'=>$application]);
        $pdf = Mccarlosen\LaravelMpdf\Facades\LaravelMpdf::loadView('exports.application', ['application'=>$application]);
        return $pdf->download('application-'.$application->id.'.pdf');
    }else{
        return response()->json(['message'=>'Not Found']);
    }
});
Route::get('/lang-{locale}.js', [HomeController::class, "getLocales"]);

Route::get('/', function () {
    return view('layouts.app');
})->middleware('localization')->name('home');

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

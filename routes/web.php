<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\contactController;
use App\Http\Controllers\invokController;
use App\Http\Controllers\secondController;



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
     return view('welcome');
});


//..controller_laravel_8..//
Route::get('/contact',[contactController::class,"index"])->name('contact.us'); //here "index" can be anything ..but good practice is using index while going any page.when submitting form "post" when editing form "edit" when deleting data "destroy" .
Route::get('/about',[contactController::class,"about"])->name('about.us');
Route::post('/about_store',[contactController::class,"aboutStore"])->name('about.store');
Route::post('/contact_store',[contactController::class,"contactStore"])->name('contact.store');

Route::get('/test',function(Request $request){
   $logfile=file(storage_path().'/logs/about.log');
   $collection=[];
   foreach($logfile as  $line_number => $line){
      $collection[]=array("content"=>htmlspecialchars($line));
   }
   dd($collection);

// Log::info("This is a test log".rand(1,30));
// return redirect()->to('/');

});

//middleware using controller.//
Route::get('/country',[contactController::class,"countryController"])->name('country.us')->middleware("country");

// //invoke method//
// Route::get("/invoke",[invokController::class,'__invoke']);
Route::get("/hello",[invokController::class,'hello'])->middleware("auth");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


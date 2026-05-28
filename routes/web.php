<?php

use App\Http\Controllers\activController;
use App\Http\Controllers\curcoController;
use App\Http\Controllers\depaController;
use App\Http\Controllers\instController;
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
    //alert()->success('Welcome to the application!');
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    //modulo administrativo

    Route::get('/inst', [instController::class, 'index'])->name('inst.index');
    Route::post('/inst/salvar',[instController::class, 'store'])->name('inst.store');
    Route::delete('/inst/{id}',[instController::class, 'destroy']);
    Route::put('/inst/{id}',[instController::class, 'update']);
    Route::get('/inst/{id}',[instController::class, 'mudar']);

    Route::get('/Depa',[depaController::class, 'index'])->name('depa.index');
    Route::post('/Depa/salvar',[depaController::class, 'store'])->name('depa.store');
    Route::put('/Depa/{id}', [depaController::class, 'update']);
    Route::delete('/Depa/{id}',[depaController::class, 'destroy']);

    Route::get('/Curço',[curcoController::class, 'index'])->name('curco.index');

    Route::get('/Activ',[activController::class, 'index'])->name('activ.index');
});

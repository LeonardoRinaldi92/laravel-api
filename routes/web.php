<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TypeController;
use App\Models\Admin\Type;
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
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});



Route::group(['prefix'=>'admin','as'=>'admin.projects.','middleware'=>'auth'], function(){
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('create');
    Route::get('/', [ProjectController::class, 'indexForEdit'])->name('indexForEdit');
    Route::post('/projects/store',[ProjectController::class, 'store'])->name(('store'));
    Route::get('/projects/{project:slug}/edit', [ProjectController::class, 'edit'])->name('edit');
    Route::put('/projects/{project}/update', [ProjectController::class, 'update'])->name('update');
    Route::get('/projects/{project}/visibility', [ProjectController::class, 'visibility'])->name('visibility');
    Route::delete('/projects/{project}/destroy',[ProjectController::class, 'destroy'])->name('destroy');

});

Route::group(['prefix'=>'projects','as'=>'projects.'], function(){
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/{project:slug}', [ProjectController::class, 'show'])->name('show');
    Route::get('/filter/{type:slug}', [ProjectController::class, 'filter'])->name('filter');

    // ->parameters(['project' => 'project:slug' ]);
});

require __DIR__.'/auth.php';

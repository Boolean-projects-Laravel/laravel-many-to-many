<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Guests\PageController as GuestsPageController;

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

Route::get('/', [GuestsPageController::class, 'home'])->name('guest.home');

Route::get('/admin', [AdminPageController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth', 'verified')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminPageController::class, 'dashboard'])->name('dashboard');


        Route::get('/projects/trashed', [ProjectController::class, 'trashed'])->name('projects.trashed');
        Route::post('/projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
        Route::delete('/projects/{project}/harddelete', [ProjectController::class, 'harddelete'])->name('projects.harddelete');

        Route::resource('projects', ProjectController::class);

        // Type route
        Route::get('types/trashed', [TypeController::class, 'trashed'])->name('types.trashed');
        Route::post('types/{type}/restore', [TypeController::class, 'restore'])->name('types.restore');
        Route::delete('types/{type}/harddelete', [TypeController::class, 'harddelete'])->name('types.harddelete');

        Route::resource('types', TypeController::class);

        Route::resource('technologies', TechnologyController::class);
    });

Route::middleware('auth')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__ . '/auth.php';

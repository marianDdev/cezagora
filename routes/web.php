<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Models\CompanyCategory;
use App\Models\ProductsCategory;
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
    return view('pages.home', ['categories' => ProductsCategory::all()]);
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/services', function () {
    return view('pages.services');
})->name('services');

Route::get('/pricing', function () {
    return view('pages.pricing');
})->name('pricing');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/help', function () {
    return view('pages.help');
})->name('help');

Route::get('/company-categories', function () {
    return view('components.company-categories-page', ['categories' => CompanyCategory::TYPES]);
})->name('company-categories');

Route::get('/dashboard', [PagesController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => '/companies'], function () {
        Route::get('/create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('/', [CompanyController::class, 'store'])->name('company.store');
        Route::get('/edit', [CompanyController::class, 'edit'])->name('company.edit');
    });

    Route::get('my-company', [CompanyController::class, 'showMyCompany'])->name('my-company');

    //ingredients
    Route::group(['prefix' => '/ingredients'], function () {
        Route::get('/', [IngredientController::class, 'list'])->name('ingredients');
        Route::get('/create', [IngredientController::class, 'create'])->name('ingredient.create');
        Route::post('/', [IngredientController::class, 'store'])->name('ingredient.store');
        Route::get('/edit', [IngredientController::class, 'edit'])->name('ingredient.edit');
    });

    Route::get('/my-ingredients', [IngredientController::class, 'listMyIngredients'])->name('my-ingredients');
});

require __DIR__ . '/auth.php';

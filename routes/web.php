<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeOnboardingController;
use App\Http\Middleware\RedirectIfUserHasNotEnabledStripe;
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

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/services', [PagesController::class, 'services'])->name('services');
Route::get('/pricing', [PagesController::class, 'pricing'])->name('pricing');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/help', [PagesController::class, 'help'])->name('help');

Route::get('/company-categories', function () {
    return view('components.company-categories-page', ['categories' => CompanyCategory::TYPES]);
})->name('company-categories');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard'])
         ->middleware(RedirectIfUserHasNotEnabledStripe::class, 'verified')
         ->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->middleware(RedirectIfUserHasNotEnabledStripe::class)
         ->name('profile.edit');
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
        Route::get('/', [IngredientController::class, 'index'])->name('ingredients');
        Route::get('/{id}', [IngredientController::class, 'show'])->name('ingredient.show');
        Route::get('/create', [IngredientController::class, 'create'])->name('ingredient.create');
        Route::post('/', [IngredientController::class, 'store'])->name('ingredient.store');
        Route::get('/{id}/edit', [IngredientController::class, 'edit'])->name('ingredient.edit');
        Route::post('/upload', [IngredientController::class, 'upload'])->name('ingredients.upload');
        Route::post('/{id}/purchase', [IngredientController::class, 'purchase'])->name('ingredients.purchase');
    });

    Route::get('/my-ingredients', [IngredientController::class, 'listMyIngredients'])->name('my-ingredients');

    //stripe
    Route::get('/onboarding', [StripeOnboardingController::class, 'index'])->name('onboarding');
    Route::get('/onboarding/redirect', [StripeOnboardingController::class, 'redirect'])->name('onboarding.redirect');
    Route::get('/onboarding/verify', [StripeOnboardingController::class, 'verify'])->name('onboarding.verify');


    //dummmy routes
    Route::get('/payment/{string}/{price}', [PaymentController::class, 'charge'])->name('goToPayment');
    Route::post('payment/process-payment/{string}/{price}', [PaymentController::class, 'processPayment'])->name('processPayment');

    Route::get('/seller', [ProfileController::class, 'show'])->name('seller.profile');
    Route::get('stripe', [ProfileController::class, 'redirectToStripe'])->name('redirect.stripe');
    Route::get('connect/{token}', [ProfileController::class, 'saveStripeAccount'])->name('save.stripe');
    Route::post('charge', [ProfileController::class, 'purchase'])->name('complete.purchase');
});

require __DIR__ . '/auth.php';

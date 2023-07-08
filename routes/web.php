<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeOnboardingController;
use App\Http\Middleware\RedirectIfUserHasNotEnabledStripe;
use App\Models\CompanyCategory;
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

Route::get('/companies-categories', function () {
    return view('components.companies-categories-page', ['categories' => CompanyCategory::TYPES]);
})->name('companies-categories');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard'])
         ->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => '/companies'], function () {
        Route::get('/', [CompanyController::class, 'index'])->name('companies');
        Route::get('/{slug}', [CompanyController::class, 'show'])->name('company.show');
        Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    });

    Route::get('my-companies', [CompanyController::class, 'showMyCompany'])->name('my-companies');

    //ingredients
    Route::group(['prefix' => '/ingredients'], function () {
        Route::get('/', [IngredientController::class, 'index'])->name('ingredients');
        Route::get('/{slug}', [IngredientController::class, 'show'])->name('ingredient.show');
        Route::get('/create', [IngredientController::class, 'create'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.create');
        Route::post('/', [IngredientController::class, 'store'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.store');
        Route::get('/{slug}/edit', [IngredientController::class, 'edit'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.edit');
        Route::post('/upload', [IngredientController::class, 'upload'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredients.upload');
    });

    Route::get('/my-ingredients', [IngredientController::class, 'listMyIngredients'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('my-ingredients');

    Route::post('/checkout', [CheckoutController::class, 'execute'])->name('checkout');
    Route::get('/checkout/success', [CheckoutController::class, 'showSucess'])->name('checkout.success');


    //stripe
    Route::get('/onboarding', [StripeOnboardingController::class, 'index'])->name('onboarding');
    Route::get('/onboarding/redirect', [StripeOnboardingController::class, 'redirect'])->name('onboarding.redirect');
    Route::get('/onboarding/verify', [StripeOnboardingController::class, 'verify'])->name('onboarding.verify');
});

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeOnboardingController;
use App\Http\Controllers\StripePortalController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WebhookController;
use App\Http\Middleware\RedirectIfUserHasNotAddedCompanyDetails;
use App\Http\Middleware\RedirectIfUserHasNotEnabledStripe;
use App\Models\CompanyCategory;
use Illuminate\Support\Facades\Route;

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
        Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/{slug}', [CompanyController::class, 'show'])->name('company.show');
        Route::get('/edit', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::put('/update', [CompanyController::class, 'update'])->name('companies.edit');
    });

    Route::get('my-company', [CompanyController::class, 'showMyCompany'])->name('my-companies');

    //ingredients
    Route::group(['prefix' => '/ingredients'], function () {
        Route::get('/create', [IngredientController::class, 'create'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.create');
        Route::post('/', [IngredientController::class, 'store'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.store');
        Route::get('/{slug}/edit', [IngredientController::class, 'edit'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.edit');
        Route::put('/update', [IngredientController::class, 'update'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.update');
        Route::post('/upload', [IngredientController::class, 'insertIngredientsFromFile'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredients.upload');
    });

    Route::get('/my-ingredients', [IngredientController::class, 'listMyIngredients'])
         ->middleware(
             [
                 RedirectIfUserHasNotAddedCompanyDetails::class,
                 RedirectIfUserHasNotEnabledStripe::class,
             ]
         )
         ->name('my-ingredients');

    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::get('/checkout/success', [CheckoutController::class, 'showSucess'])->name('checkout.success');

    //orders
    Route::group(['prefix' => '/orders'], function () {
        Route::get('/', [OrderController::class, 'listOrders'])->name('orders');
        Route::get('/{id}', [OrderController::class, 'show'])->name('order.show');
        Route::get('/create', [OrderController::class, 'create'])
             ->middleware(
                 [
                     RedirectIfUserHasNotEnabledStripe::class,
                     RedirectIfUserHasNotAddedCompanyDetails::class,
                 ]
             )
             ->name('order.create');
        Route::post('/', [OrderController::class, 'store'])
             ->middleware(
                 [
                     RedirectIfUserHasNotEnabledStripe::class,
                     RedirectIfUserHasNotAddedCompanyDetails::class,
                 ]
             )
             ->name('order.store');
        Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
        Route::put('/{id}', [OrderController::class, 'update'])->name('order.update');
    });

    //sales
    Route::group(['prefix' => '/sales'], function () {
        Route::get('/', [OrderController::class, 'listSales'])->name('sales');
    });

    //order items
    Route::group(['prefix' => '/order-items'], function () {
        Route::get('/{orderId}', [OrderItemController::class, 'index'])->name('order-items');
        Route::get('/{id}', [OrderItemController::class, 'show'])->name('order-item.show');
        Route::post('/', [OrderItemController::class, 'store'])
             ->middleware(
                 [
                     RedirectIfUserHasNotEnabledStripe::class,
                     RedirectIfUserHasNotAddedCompanyDetails::class,
                 ]
             )
             ->name('order-item.store');
    });

    Route::group(['prefix' => '/payments'], function () {
        Route::post('/', [PaymentController::class, 'chargeCustomer'])->name('payment.charge');
    });

    Route::group(['prefix' => '/transfers'], function () {
        Route::get('/{orderId}', [TransferController::class, 'getTransferPage'])->name('transfer.show');
        Route::post('/', [TransferController::class, 'transferToSellers'])->name('transfer.create');
    });

    //stripe
    Route::get('/onboarding', [StripeOnboardingController::class, 'index'])->name('onboarding');
    Route::get('/onboarding/redirect', [StripeOnboardingController::class, 'redirect'])->name('onboarding.redirect');
    Route::get('/onboarding/verify', [StripeOnboardingController::class, 'verify'])->name('onboarding.verify');

    Route::post('/create-customer-portal-session', [StripePortalController::class, 'createSession'])->name('create.stripe.portal.session');

    //webhooks
    Route::post('/webhooks/payment-intent', [WebhookController::class, 'handlePaymentIntentSucceeded'])->name('webhook.paymentIntent');
    Route::post('/webhooks/transfers', [WebhookController::class, 'handleTransfers'])->name('webhook.trasfers');
});

Route::group(['prefix' => '/ingredients'], function () {
    Route::get('/', [IngredientController::class, 'index'])->name('ingredients');
    Route::get('/{slug}', [IngredientController::class, 'show'])->name('ingredient.show');
});

require __DIR__ . '/auth.php';

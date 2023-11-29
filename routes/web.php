<?php

use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Order\OrderIngredientController;
use App\Http\Controllers\Packaging\PackagingController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Payment\CheckoutController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\StripeOnboardingController;
use App\Http\Controllers\Payment\StripePortalController;
use App\Http\Controllers\Payment\TransferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhookController;
use App\Http\Middleware\RedirectIfUserHasNotAddedCompanyDetails;
use App\Http\Middleware\RedirectIfUserHasNotEnabledStripe;
use App\Models\CompanyCategory;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/pricing', [PagesController::class, 'pricing'])->name('pricing');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/help', [PagesController::class, 'help'])->name('help');
Route::get('/faq', [PagesController::class, 'faq'])->name('faq');
Route::get('/guides', [PagesController::class, 'guides'])->name('guides');
Route::get('/video-tutorials', [PagesController::class, 'videoTutorials'])->name('video.tutorials');
Route::get('/user-roles', [PagesController::class, 'userRoles'])->name('help.user.roles');
Route::get('/advertising-policy', [PagesController::class, 'advertising'])->name('advertising');
Route::get('/terms-conditions', [PagesController::class, 'termsAndConditions'])->name('terms.conditions');
Route::get('/cookie-policy', [PagesController::class, 'cookie'])->name('cookie');
Route::get('/copyright-policy', [PagesController::class, 'copyright'])->name('copyright');
Route::get('/branding-policy', [PagesController::class, 'branding'])->name('branding');
Route::get('/general-policies', [PagesController::class, 'generalPolicies'])->name('general.policies');
Route::get('/privacy-policy', [PagesController::class, 'privacy'])->name('privacy');
Route::get('/policies', [PagesController::class, 'policies'])->name('policies');
Route::get('/settings', [PagesController::class, 'settings'])->name('settings');
Route::get('/account-deactivated', [PagesController::class, 'accountDeactivatedConfirmationPage'])->name('account.deactivated.page');
Route::get('/account-reactivated', [PagesController::class, 'accountReactivatedConfirmationPage'])->name('account.reactivated.page');
Route::get('/contact-message-sent', [PagesController::class, 'contactMessageSent'])->name('contact.message.sent');

Route::group(['prefix' => '/ingredients'], function () {
    Route::get('/', [IngredientController::class, 'index'])->name('ingredients');
    Route::post('/', [IngredientController::class, 'search'])->name('ingredients.search');
});

Route::group(['prefix' => '/packagings'], function () {
    Route::get('/', [PackagingController::class, 'index'])->name('packaging.index');
});

Route::group(['prefix' => '/search'], function () {
    Route::post('/global', [SearchController::class, 'globalSearch'])->name('search.global');
});

Route::get('/companies-categories', function () {
    return view('components.companies-categories-page', ['categories' => CompanyCategory::TYPES]);
})->name('companies-categories');

Route::post('/contact-message', [ContactMessageController::class, 'store'])->name('contact-message.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard'])
         ->name('dashboard');
    Route::get('/my-products-and-services', [PagesController::class, 'renderMyProductAndServices'])
        ->name('my.products.services');
    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/activate-account', [PagesController::class, 'activateAccount'])->name('activate.account');

    //users
    Route::group(['prefix' => '/users'], function () {
        Route::patch('/{id}', [UserController::class, 'toggleActive'])->name('user.toggle.activate');
    });

    //companies
    Route::group(['prefix' => '/companies'], function () {
        Route::get('/', [CompanyController::class, 'index'])->name('companies');
        Route::patch('/update', [CompanyController::class, 'update'])->name('company.update');
        Route::post('/', [CompanyController::class, 'store'])->name('company.store');
        Route::get('/{slug}', [CompanyController::class, 'show'])->name('company.show');
    });

    Route::get('my-company', [CompanyController::class, 'showMyCompany'])->name('my-companies');

    //ingredients
    Route::group(['prefix' => '/ingredients'], function () {
        Route::get('/create', [IngredientController::class, 'create'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.create');
        Route::post('/', [IngredientController::class, 'store'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.store');
        Route::get('/{id}/edit', [IngredientController::class, 'edit'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.edit');
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
    Route::get('/checkout/success', [CheckoutController::class, 'showSuccess'])->name('checkout.success');

    //orders
    Route::group(['prefix' => '/orders'], function () {
        Route::get('/', [OrderController::class, 'listOrders'])->name('orders');
        Route::get('/{id}', [OrderController::class, 'show'])->name('order.show');
        Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
        Route::put('/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::post('/ingredient/store', [OrderIngredientController::class, 'store'])
             ->middleware(
                 [
                     RedirectIfUserHasNotEnabledStripe::class,
                     RedirectIfUserHasNotAddedCompanyDetails::class,
                 ]
             )
             ->name('ingredient.order-item.store');
    });

    //sales
    Route::group(['prefix' => '/sales'], function () {
        Route::get('/', [OrderController::class, 'listSales'])->name('sales');
    });

    //order items
    Route::group(['prefix' => '/order-items'], function () {
        Route::get('/{orderId}', [OrderIngredientController::class, 'index'])->name('order-items');
        Route::get('/{id}', [OrderIngredientController::class, 'show'])->name('order-item.show');

        Route::post('/{id}/cancel', [OrderIngredientController::class, 'cancel'])->name('order-item.cancel');
    });

    Route::group(['prefix' => '/payments'], function () {
        Route::post('/', [PaymentController::class, 'chargeCustomer'])->name('payment.charge');
    });

    Route::group(['prefix' => '/transfers'], function () {
        Route::get('/', [TransferController::class, 'listTransfersToExecute'])->name('transfer.list');
        Route::get('/{orderId}', [TransferController::class, 'getTransferPage'])->name('transfer.show');
        Route::post('/', [TransferController::class, 'transferToSellers'])->name('transfer.create');
    });

    Route::group(['prefix' => '/packaging'], function () {
        Route::get('/create', [PackagingController::class, 'create'])->name('packaging.create');
        Route::post('/', [PackagingController::class, 'store'])->name('packaging.store');
        Route::get('/edit/{id}', [PackagingController::class, 'edit'])->name('packaging.edit');
        Route::patch('/{id}', [PackagingController::class, 'update'])->name('packaging.update');
    });

    Route::get('/my-packaging', [PackagingController::class, 'listMyPackaging'])
         ->middleware(
             [
                 RedirectIfUserHasNotAddedCompanyDetails::class,
                 RedirectIfUserHasNotEnabledStripe::class,
             ]
         )
         ->name('my-packaging');

    //stripe
    Route::get('/onboarding', [StripeOnboardingController::class, 'index'])->name('onboarding');
    Route::get('/onboarding/redirect', [StripeOnboardingController::class, 'redirect'])->name('onboarding.redirect');
    Route::get('/onboarding/verify', [StripeOnboardingController::class, 'verify'])->name('onboarding.verify');

    Route::post('/create-customer-portal-session', [StripePortalController::class, 'createSession'])->name('create.stripe.portal.session');

    //webhooks
    Route::post('/webhooks/payment-intent', [WebhookController::class, 'handlePaymentIntentSucceeded'])->name('webhook.paymentIntent');
    Route::post('/webhooks/transfers', [WebhookController::class, 'handleTransfers'])->name('webhook.trasfers');

    //email previews
    Route::get('preview/{emailName}', [PagesController::class, 'previewEmail'])->name('preview.email');

    Route::post('/upload', [FileController::class, 'upload'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('upload');
});

require __DIR__ . '/auth.php';

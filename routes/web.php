<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\IngredientVariantController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Order\OrderIngredientController;
use App\Http\Controllers\Order\OrderItemController;
use App\Http\Controllers\Packaging\PackagingController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Payment\CheckoutController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\StripeOnboardingController;
use App\Http\Controllers\Payment\StripePortalController;
use App\Http\Controllers\Payment\TransferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhookController;
use App\Http\Middleware\RedirectIfUserHasNotAddedCompanyDetails;
use App\Http\Middleware\RedirectIfUserHasNotEnabledStripe;
use App\Http\Middleware\RedirectIfUserNotAdmin;
use App\Models\CompanyCategory;
use Illuminate\Support\Facades\Route;

Route::get('/robots.txt', [RobotsController::class, 'index']);

Route::get('/', [PagesController::class, 'showHome'])->name('home');
Route::get('/about', [PagesController::class, 'showAbout'])->name('about');
Route::get('/pricing', [PagesController::class, 'showPricing'])->name('pricing');
Route::get('/help', [PagesController::class, 'showHelp'])->name('help');
Route::get('/faq', [PagesController::class, 'showFaq'])->name('faq');
Route::get('/guides', [PagesController::class, 'showGuides'])->name('guides');
Route::get('/video-tutorials', [PagesController::class, 'showVideoTutorials'])->name('video.tutorials');
Route::get('/user-roles', [PagesController::class, 'showUserRoles'])->name('help.user.roles');
Route::get('/advertising-policy', [PagesController::class, 'showAdvertising'])->name('advertising');
Route::get('/terms-conditions', [PagesController::class, 'showTermsAndConditions'])->name('terms.conditions');
Route::get('/cookie-policy', [PagesController::class, 'showCookie'])->name('cookie');
Route::get('/copyright-policy', [PagesController::class, 'showCopyright'])->name('copyright');
Route::get('/branding-policy', [PagesController::class, 'showBranding'])->name('branding');
Route::get('/general-policies', [PagesController::class, 'showGeneralPolicies'])->name('general.policies');
Route::get('/privacy-policy', [PagesController::class, 'showPrivacy'])->name('privacy');
Route::get('/policies', [PagesController::class, 'showPolicies'])->name('policies');

Route::get('/error', [PagesController::class, 'showGenericError'])->name('generic-error');

Route::get('/account-deactivated', [AccountController::class, 'showAccountDeactivatedConfirmationPage'])->name('account.deactivated.page');
Route::get('/account-reactivated', [AccountController::class, 'showAccountReactivatedConfirmationPage'])->name('account.reactivated.page');

Route::get('/contact', [ContactMessageController::class, 'index'])->name('contact');
Route::get('/contact-message-sent', [ContactMessageController::class, 'showMessageSent'])->name('contact.message.sent');

Route::get('/products-services-categories', [PagesController::class, 'showProductsAndServicesCategories'])->name('products.services.categories');

//ingredients variants
Route::group(['prefix' => '/ingredients-variants'], function () {
    Route::get('/create/{ingredientId}', [IngredientVariantController::class, 'create'])->name('ingredient.variant.create');
    Route::post('/', [IngredientVariantController::class, 'store'])->name('ingredient.variant.store');
});

Route::group(['prefix' => '/ingredients'], function () {
    Route::get('/', [IngredientController::class, 'index'])->name('ingredients');
    Route::post('/', [IngredientController::class, 'search'])->name('ingredients.search');
});

Route::group(['prefix' => '/packaging'], function () {
    Route::get('/', [PackagingController::class, 'index'])->name('packaging.index');
});

Route::group(['prefix' => '/search'], function () {
    Route::get('/results', [SearchController::class, 'showResults'])->name('search.results');
    Route::post('/global', [SearchController::class, 'globalSearch'])->name('search.global');
});

Route::get('/companies-categories', function () {
    return view('components.companies-categories-page', ['categories' => CompanyCategory::TYPES]);
})->name('companies-categories');

Route::post('/contact-message', [ContactMessageController::class, 'store'])->name('contact-message.store');

Route::post('/language-switch', [LanguageController::class, 'switchLanguage'])->name('language.switch');

Route::middleware(['auth', 'verified'])->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');
    Route::get('/my-products-and-services', [DashboardController::class, 'showMyProductsAndServices'])
         ->name('my.products.services');
    Route::get('/settings', [DashboardController::class, 'showSettings'])->name('settings');

    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/activate-account', [AccountController::class, 'showActivateAccount'])->name('activate.account');

    //users
    Route::group(['prefix' => '/users'], function () {
        Route::post('/upload-profile-image', [UserController::class, 'uploadProfileImage'])->name('profile-image.store');
        Route::post('/toggle-role', [UserController::class, 'toggleRole'])->name('user.toggle-role');
        Route::patch('/{id}', [UserController::class, 'toggleActive'])->name('user.toggle.activate');
    });

    //companies
    Route::group(['prefix' => '/companies'], function () {
        Route::get('/', [CompanyController::class, 'index'])->name('companies');
        Route::get('/{slug}', [CompanyController::class, 'show'])->name('company.show');
        Route::post('/', [CompanyController::class, 'store'])->name('company.store');
        Route::post('/upload-logo-image', [CompanyController::class, 'uploadLogo'])->name('logo-image.store');
        Route::patch('/update', [CompanyController::class, 'update'])->name('company.update');
    });

    Route::get('my-company', [CompanyController::class, 'showMyCompany'])->name('my-companies');

    //ingredients
    Route::group(['prefix' => '/ingredients'], function () {
        Route::get('/create/forms', [IngredientController::class, 'showCreateForms'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.create.forms');
        Route::get('/create', [IngredientController::class, 'create'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.create');
        Route::post('/', [IngredientController::class, 'store'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.store');
        Route::patch('/update', [IngredientController::class, 'update'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('ingredient.update');
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
        Route::delete('/{id}', [OrderItemController::class, 'delete'])->name('order-item.delete');
    });

    Route::group(['prefix' => '/payments'], function () {
        Route::get('/success', [PaymentController::class, 'showSuccessPage'])->name('payment.success');
        Route::post('/', [PaymentController::class, 'chargeCustomer'])->name('payment.charge');
        Route::post('/create-intent', [PaymentController::class, 'createIntentAfter3DSecure'])->name('payment.create-intent');

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

    //documents
    Route::group(['prefix' => '/documents'], function () {
        Route::get('/create/{ingredientId}', [DocumentController::class, 'create'])->name('document.create');
        Route::post('/', [DocumentController::class, 'store'])->name('document.store');
    });

    //qualifications
    Route::group(['prefix' => '/qualifications'], function () {
        Route::get('/{companyId}', [QualificationController::class, 'listByCompanyId'])->name('qualifications.list_by_company');
        Route::get('/create', [QualificationController::class, 'create'])->name('qualification.create');
        Route::post('/', [QualificationController::class, 'store'])->name('qualification.store');
    });
    Route::get('my-qualifications', [QualificationController::class, 'showMyQualifications'])->name('my-qualifications');

    //stripe
    Route::get('/onboarding', [StripeOnboardingController::class, 'index'])->name('onboarding');
    Route::get('/onboarding/redirect', [StripeOnboardingController::class, 'redirect'])->name('onboarding.redirect');
    Route::get('/onboarding/verify', [StripeOnboardingController::class, 'verify'])->name('onboarding.verify');

    Route::post('/create-customer-portal-session', [StripePortalController::class, 'createSession'])->name('create.stripe.portal.session');

    //email previews
    Route::get('preview/{emailName}', [AdminController::class, 'previewEmail'])->name('preview.email');
    Route::get('send/invitation', [AdminController::class, 'testEmail'])->name('invitation.email');

    Route::post('/upload', [FileController::class, 'upload'])->middleware(RedirectIfUserHasNotEnabledStripe::class)->name('upload');


    //services
    Route::get('/my-services', [ServiceController::class, 'listMyServices'])
         ->middleware(
             [
                 RedirectIfUserHasNotAddedCompanyDetails::class,
                 RedirectIfUserHasNotEnabledStripe::class,
             ]
         )
         ->name('my_services');

    Route::group(['prefix' => '/services'], function () {
        Route::get('/', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('service.create');
        Route::post('/', [ServiceController::class, 'store'])->name('service.store');
    });

    //equipment
    Route::get('/my-equipment', [EquipmentController::class, 'listMyEquipment'])
         ->middleware(
             [
                 RedirectIfUserHasNotAddedCompanyDetails::class,
                 RedirectIfUserHasNotEnabledStripe::class,
             ]
         )
         ->name('my_equipment');

    Route::group(['prefix' => '/equipment'], function () {
        Route::get('/', [EquipmentController::class, 'index'])->name('equipment.index');
        Route::get('/create', [EquipmentController::class, 'create'])->name('equipment.create');
        Route::post('/', [EquipmentController::class, 'store'])->name('equipment.store');
    });

    Route::group(['prefix' => '/ratings'], function () {
        Route::get('/{slug}', [RatingController::class, 'index'])->name('ratings.index');
        Route::post('/', [RatingController::class, 'submitRating'])->name('rating.submit');
    });

    Route::get('/carriers/dummy-data', [CarrierController::class, 'showDummyCarrierData']);

    //ADMIN
    Route::group(
        [
            'prefix'     => '/admin',
            'middleware' => RedirectIfUserNotAdmin::class,
        ],
        function () {
            Route::get('/', [AdminController::class, 'showAdminPage'])->name('admin.index');

            Route::group(
                [
                    'prefix' => '/campaigns',
                ],
                function () {
                    Route::get('/', [CampaignController::class, 'index'])->name('campaigns.index');
                    Route::get('/create', [CampaignController::class, 'create'])->name('campaign.create');
                    Route::post('/', [CampaignController::class, 'store'])->name('campaign.store');
                }
            );

            Route::group(
                [
                    'prefix' => '/emails',
                ],
                function () {
                    Route::get('/', [AdminController::class, 'adminEmailsIndex'])->name('admin.emails.index');

                    Route::group(
                        [
                            'prefix' => '/invitations',
                        ],
                        function () {
                            Route::get('/create', [NotificationController::class, 'createMembershipInvitation'])->name('membership_invitation.create');
                            Route::post('/', [NotificationController::class, 'storeMembershipInvitation'])->name('membership_invitation.store');
                        }
                    );
                }
            );

            Route::get('users', [UserController::class, 'index'])->name('admin.users.index');

            Route::get('searches', [SearchController::class, 'index'])->name('searches.index');

            Route::get('messages', [ContactMessageController::class, 'adminIndex'])->name('contact.messages.admin.index');
        }
    );

    //webhooks
    Route::group(['prefix' => '/webhooks'], function () {
        Route::post('/payment-intent', [WebhookController::class, 'handlePaymentIntent'])->name('webhook.paymentIntent');
        Route::post('/transfers', [WebhookController::class, 'handleTransfers'])->name('webhook.trasfers');
    });

});

require __DIR__ . '/auth.php';

<?php

namespace App\Http\Controllers;

use App\Models\ProductsCategory;
use App\Services\Carrier\CarrierServiceInterface;
use App\Services\Pages\PagesServiceInterface;
use App\Services\Stripe\Account\StripeAccountServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    use AuthUser;

    public function showHome(
        StripeAccountServiceInterface $stripeAccountService,
        PagesServiceInterface         $pagesService,
        CarrierServiceInterface $carrierService
    ): View
    {
        if (Auth::check() && $this->authUser()->hasRole(UserServiceInterface::ROLE_SELLER)) {
            return view('dashboard.index', $pagesService->getDashboardData($stripeAccountService));
        }

        if (Auth::check() && $this->authUser()->hasRole(UserServiceInterface::ROLE_BUYER)) {
            dd($carrierService->getAuthToken());
            return view('pages.products_services_categories');
        }

        if (Auth::check() && $this->authUser()->hasRole(UserServiceInterface::ROLE_ADMIN)) {
            return view('admin.index');
        }

        return view(
            'pages.home.main',
            [
                'categories' => ProductsCategory::all(),
            ]
        );
    }

    public function showAbout(): View
    {
        return view('pages.about.index');
    }

    public function showContact(): View
    {
        return view('pages.contact');
    }

    public function showHelp(): View
    {
        return view('pages.help.index');
    }

    public function showPricing(): View
    {
        return view('pages.pricing');
    }

    public function contactMessageSent(): View
    {
        return view('pages.contact-message-sent');
    }

    public function showFaq(): View
    {
        return view('pages.help.faq');
    }

    public function showGuides(): View
    {
        return view('pages.help.guides');
    }

    public function showPolicies(): View
    {
        return view('pages.help.policies');
    }

    public function showAdvertising(): View
    {
        return view('pages.tc_and_policies.advertising.main');
    }

    public function showCookie(): View
    {
        return view('pages.tc_and_policies.cookie');
    }

    public function showBranding(): View
    {
        return view('pages.tc_and_policies.branding');
    }

    public function showGeneralPolicies(): View
    {
        return view('pages.tc_and_policies.general');
    }

    public function showPrivacy(): View
    {
        return view('pages.tc_and_policies.privacy');
    }

    public function showCopyright(): View
    {
        return view('pages.tc_and_policies.copyright');
    }

    public function showTermsAndConditions(): View
    {
        return view('pages.tc_and_policies.terms_conditions');
    }

    public function showVideoTutorials(): View
    {
        return view('pages.help.video_tutorials');
    }

    public function showUserRoles(): View
    {
        return view('pages.help.user_roles');
    }

    public function showProductsAndServicesCategories(): View
    {
        return view('pages.products_services_categories');
    }
}

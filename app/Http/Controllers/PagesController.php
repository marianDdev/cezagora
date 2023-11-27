<?php

namespace App\Http\Controllers;

use App\Models\CompanyCategory;
use App\Models\MerchantCategoryCode;
use App\Models\ProductsCategory;
use App\Services\Pages\PagesServiceInterface;
use App\Services\Stripe\Account\StripeAccountServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class PagesController extends Controller
{
    use AuthUser;

    public function home(): View
    {
        return view(
            'pages.home.main',
            [
                'categories' => ProductsCategory::all(),
            ]
        );
    }

    public function about(): View
    {
        return view('pages.about.index');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function help(): View
    {
        return view('pages.help.main');
    }

    public function pricing(): View
    {
        return view('pages.pricing');
    }

    public function dashboard(
        StripeAccountServiceInterface $stripeAccountService,
        PagesServiceInterface         $pagesService,
    ): View
    {
        return view('pages.dashboard', $pagesService->getDashboardData($stripeAccountService));
    }

    public function settings(): View
    {
        return view('pages.settings');
    }

    public function accountDeactivatedConfirmationPage(): View
    {
        return view('pages.account-deactivated-confirmation');
    }

    public function accountReactivatedConfirmationPage(): View
    {
        return view('pages.account-reactivated-confirmation');
    }

    public function activateAccount(): View
    {
        return view('pages.activate_account');
    }

    public function contactMessageSent(): View
    {
        return view('pages.contact-message-sent');
    }

    public function faq(): View
    {
        return view('pages.help.faq');
    }

    public function guides(): View
    {
        return view('pages.help.guides');
    }

    public function policies(): View
    {
        return view('pages.help.policies');
    }

    public function advertising(): View
    {
        return view('pages.tc_and_policies.advertising.main');
    }

    public function cookie(): View
    {
        return view('pages.tc_and_policies.cookie');
    }

    public function branding(): View
    {
        return view('pages.tc_and_policies.branding');
    }

    public function generalPolicies(): View
    {
        return view('pages.tc_and_policies.general');
    }

    public function privacy(): View
    {
        return view('pages.tc_and_policies.privacy');
    }

    public function copyright(): View
    {
        return view('pages.tc_and_policies.copyright');
    }

    public function termsAndConditions(): View
    {
        return view('pages.tc_and_policies.terms_conditions');
    }

    public function videoTutorials(): View
    {
        return view('pages.help.video_tutorials');
    }

    public function userRoles(): View
    {
        return view('pages.help.user_roles');
    }

    public function renderMyProductAndServices(): View
    {
        $user = $this->authUser();
        $ingredientsCount = $user->company ? $user->company->ingredients->count() : 0;
        $productsCount = $user->company ? $user->company->products->count() : 0;

        return view(
            'pages.products_and_services',
            [
                'ingredientsCount' => $ingredientsCount,
                'productsCount'    => $productsCount,
            ]
        );
    }

    public function previewEmail(string $emailName): View
    {
        $name = $emailName;
        $user = $this->authUser();

        return view(sprintf('vendor.notifications.%s', $name), ['user' => $user]);
    }
}

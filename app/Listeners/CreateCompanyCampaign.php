<?php

namespace App\Listeners;

use App\Events\CompanyCreated;
use App\Models\Campaign;
use App\Models\CompanyCampaign;
use App\Notifications\SignupBonusReceived;
use App\Services\Campaign\CampaignServiceInterface;
use Carbon\Carbon;

class CreateCompanyCampaign
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyCreated $event): void
    {
        $company                        = $event->company;
        $signupBonusCampaign            = Campaign::where('name', CampaignServiceInterface::SIGNUP_BONUS)->first();
        $signupBonusCampaignNotFinished = is_null($signupBonusCampaign->end_at) || $signupBonusCampaign->end_at->gt(Carbon::today());
        $companyCampaign                = CompanyCampaign::where(['company_id' => $company->id, 'campaign_id' => $signupBonusCampaign->id])->first();
        $shouldGiveSignupBonus = $signupBonusCampaignNotFinished && is_null($companyCampaign);

        if ($shouldGiveSignupBonus) {
            $newCompanyCampaign = CompanyCampaign::create(
                [
                    'company_id'  => $company->id,
                    'campaign_id' => $signupBonusCampaign->id,
                    'count'       => 0,
                ]
            );

            if (!is_null($newCompanyCampaign)) {
                $company->user->notify(new SignupBonusReceived());
            }
        }
    }
}

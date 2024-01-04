<?php

namespace App\Listeners;

use App\Events\CompanyCreated;
use App\Models\Campaign;
use App\Models\CompanyCampaign;
use App\Services\Campaign\CampaignServiceInterface;

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
        $company  = $event->company;
        $campaign = Campaign::where('name', CampaignServiceInterface::SIGNUP_BONUS)->first();

        if (is_null(CompanyCampaign::where(['company_id' => $company->id, 'campaign_id' => $campaign->id])->first())) {
            CompanyCampaign::create(
                [
                    'company_id'  => $company->id,
                    'campaign_id' => $campaign->id,
                    'count'       => 0,
                ]
            );
        }
    }
}

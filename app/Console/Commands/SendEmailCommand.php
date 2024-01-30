<?php

namespace App\Console\Commands;

use App\Models\Ingredient;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\OrderToDeliverNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails programmatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderItems = OrderItem::all();
        if ($orderItems->count() === 0) {
            return;
        }

        /** @var OrderItem $item */
        foreach ($orderItems as $item) {
            if ($item->item_type === 'ingredient') {

                /** @var Ingredient $ingredient */
                $ingredient = Ingredient::find($item->item_id);
                $oneWeekPast = Carbon::parse($ingredient->available_at)->diffInDays(Carbon::now()) === 7;
                $timeToDeliver = Carbon::parse($ingredient->available_at)->diffInDays(Carbon::now()) === 0;
                $user = $ingredient->company->user;

                if ($oneWeekPast) {
                    $user->notify(new OrderToDeliverNotification($item, 7));
                }

                if ($timeToDeliver) {
                    $user->notify(new OrderToDeliverNotification($item, 0));
                }
            }
        }
    }
}

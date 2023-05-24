<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\PaymentEnum;
use App\Enums\StatusEnum;
use App\Models\Customer;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckEventSubscriptionCommand extends Command
{
    protected $signature = 'subscription:check';

    protected $description = 'Check event subscription';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $events = Event::query()
            ->where('date', '<=', Carbon::now()->addDay(7)->toDateString())
            ->where('payment', '=', PaymentEnum::PAID)
            ->where('status', '=', StatusEnum::ACTIVE)
            ->get();

        foreach ($events as $event) {
            $customers = Customer::query()->get();
            foreach ($customers as $customer) {
                if ($event->id === $customers->id) {

                }
            }
        }
    }
}

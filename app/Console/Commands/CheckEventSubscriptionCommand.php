<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckEventSubscriptionCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'subscription:check';

    /**
     * @var string
     */
    protected $description = 'Check event subscription';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $users = User::query()
            ->where('role', '!=', 1)
            ->where('role', '!=', 2)
            ->where('role', '!=', 3)
            ->get();
    }
}

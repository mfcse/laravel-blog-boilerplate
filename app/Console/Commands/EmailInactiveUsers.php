<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Notifications\notifyInactiveUser;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailInactiveUsers extends Command implements ShouldQueue
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Inactive Users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = Carbon::now()->subDay(7);
        $inactive_users = User::where('last_login', '<', $limit)->get();
        //info($inactive_users);

        foreach ($inactive_users as $user) {
            $user->notify(new NotifyInactiveUser());
            $this->info('Email sent to ' . $user->email);
        }
    }
}
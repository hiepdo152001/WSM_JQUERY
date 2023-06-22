<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Console\Command;

class UpdateLeaveDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leaveDays:add';
    /**
     * The name and signature of the console command.
     *
     * @var UserService
     */
    protected $userService;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'automatically add 1 day of leave';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            $this->userService->leaveDays($user->id);
        }
    }
}

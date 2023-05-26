<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\WorkTimeNotify;
use App\Services\CalendarService;
use Illuminate\Console\Command;

class WorkTimeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'worktime:send';
    /**
     * 
     *
     * @var CalendarService
     */
    protected $calendarService;
    /**
     *
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification emails include work_time to users';


    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDate = date('Y-m-d');
        if (date('d', strtotime($currentDate)) == '01') {
            $previousMonth = date('m', strtotime('-1 month', strtotime($currentDate)));

            $users = User::select('id', 'email')->get();
            foreach ($users as $user) {
                $id = $user->id;
                $work_time = $this->calendarService->getWorkTime($id);
                $user->notify(new WorkTimeNotify($user, $work_time));
            }
        }
    }
}

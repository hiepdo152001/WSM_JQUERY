<?php

namespace App\Services;

use App\Models\Time_keep;
use App\Models\User;
use Date;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CalendarService
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($id)
    {
        $dateNow = date('Y-m-d H:i:s');
        $day = date('d', strtotime($dateNow));
        $month_keep = date('m', strtotime($dateNow));
        $time_keep = Time_keep::create([
            'user_id' => $id,
            'time_in' => $dateNow,
            'day' => $day,
            'month' => $month_keep,
        ]);
        return $time_keep;
    }
    public function update($id)
    {
        $dateNow = date('Y-m-d H:i:s');
        $day = date('d', strtotime($dateNow));
        $month = date('m', strtotime($dateNow));
        $dayCheck = $day;

        $time_keep = Time_keep::where('user_id', $id)
            ->where('day', $dayCheck)
            ->first();
        $time_keep->time_out = $dateNow;
        $time_keep->save();

        $time_in = $time_keep->time_in;
        $time_out = $time_keep->time_out;

        $time_in_dt = new DateTime($time_in);
        $time_out_dt = new DateTime($time_out);

        $time13h = new DateTime();
        $time12h = new DateTime();
        $time13h->setTime(13, 0, 0);
        $time13h->format('Y-m-d H:i:s');
        $time12h->setTime(12, 0, 0);
        $time12h->format('Y-m-d H:i:s');

        $diff = $time_in_dt->diff($time_out_dt);
        $h = $diff->h;
        $i = $diff->i;
        $result = $h  + $i / 60;

        $work_time = round($result, 1);

        if ($time_in_dt <= $time12h &&  $time13h <= $time_out_dt) {
            $work_time -= 1;
        } elseif ($time_in_dt <= $time12h &&  $time12h <= $time_out_dt  &&  $time_out_dt <= $time13h) {
            $time = $time12h->diff($time_out_dt);
            $time_redundant = $time->h + ($time->i / 60);
            $work_time -= $time_redundant;
        } elseif ($time12h <= $time_in_dt &&  $time_in_dt <= $time13h && $time_out_dt >= $time13h) {
            $time = $time_in_dt->diff($time13h);
            $time_redundant = $time->h + ($time->i / 60);
            $work_time -= $time_redundant;
        }
        $work_time = round(($work_time / 8), 1);
        $time_keep->work_time = $work_time;

        $time_keep->save();

        return $time_keep;
    }

    public function getByUserId($id)
    {
        return Time_keep::where('user_id', $id)
            ->get();
    }
    public function getByDay($id)
    {
        $dateNow = date('Y-m-d H:i:s');
        $day = date('d', strtotime($dateNow));
        $month_keep = date('m', strtotime($dateNow));
        return Time_keep::Where('user_id', $id)
            ->where('day', $day)
            ->where('month', $month_keep)
            ->first();
    }

    public function getWorkTime($id)
    {
        $dateNow = date('Y-m-d H:i:s');
        $month_keep = date('m', strtotime('-1 month', strtotime($dateNow)));
        return Time_keep::where('user_id', $id)
            ->where('month', $month_keep)
            ->sum('work_time');
    }
}

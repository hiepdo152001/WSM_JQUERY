<?php

namespace App\Services;

use App\Models\Time_keep;
use App\Models\User;
use Date;
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
}

<?php

namespace Database\Factories;

use Date;
use Illuminate\Database\Eloquent\Factories\Factory;

class Time_keepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dateNow = date('Y-m-d H:i:s');
        $day = date('d', strtotime($dateNow));
        $month_keep = date('m', strtotime($dateNow));
        return [
            'time_in' => date('Y-m-d H:i:s'),
            'day' => $day,
            'month' => $month_keep,
            'work_time' => null,
        ];
    }
}

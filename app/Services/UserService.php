<?php

namespace App\Services;

use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Integer;

class UserService
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var CalendarService
     */
    protected $calendarService;

    public function __construct(User $user, CalendarService $calendarService)
    {
        $this->user = $user;
        $this->calendarService = $calendarService;
    }

    public function createUser($request)
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }

    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }
    public function editUser($id, array $payload)
    {
        $user = User::find($id);
        return $user->update($payload);
    }

    public function getUserById($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function newPassword(string $email, string $password)
    {
        return $this->user->where('email', $email)->update([
            'password' => Hash::make($password)
        ]);
    }

    public function getEmailById($id)
    {
        $email = User::where('id', $id)->value('email');
        return $email;
    }
    public function getEmailByPosition($department, $position)
    {
        $email = User::where('position', $position)
            ->where('department', $department)
            ->value('email');

        return $email;
    }

    public function getTime($timeStart, $timeEnd)
    {
        $datetime1 = new DateTime($timeStart);

        $datetime2 = new DateTime($timeEnd);
        $dayOn = 0;
        $diff = $datetime1->diff($datetime2);

        $time = $diff->d * 24 + $diff->h + $diff->i / 60;

        $days = $diff->d;

        //cung mot ngay
        if ($days === 0) {
            if ($time < 8) {
                $dayOn += $this->calendarService->setTime($timeStart, $timeEnd);
            } else {
                $dayOn += 1;
            }
        } else {
            // qua mot ngay
            $dayOn += $days;

            $residual = $time - $days * 24;

            if ($residual > 0) {
                $time_in = new DateTime($timeStart);
                $time_out = new DateTime($timeEnd);

                $time_in->setDate($time_out->format('Y'), $time_out->format('m'), $time_out->format('d'));

                $times_in = $time_in->format('Y-m-d H:i:s.u');

                $dayOn += $this->calendarService->setTime($times_in, $timeEnd);
            }
        }
        return $dayOn;
    }
}

<?php

namespace App\Services;

use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Integer;

class UserService extends CrudService
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
        parent::__construct($this->user);
    }

    public function create(array $payload)
    {
        $payload['password'] = Hash::make($payload['password']);
        return parent::create($payload);
    }

    public function getByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    public function check($email)
    {
        $status = User::where('email', $email)
            ->value('status');
        return $status;
    }

    public function deActive($id)
    {
        $user = User::find($id);
        if ($user === null) {
            return $user;
        }
        $user->status = "deActive";
        $user->save();
        return $user;
    }

    public function Active($id)
    {
        $user = User::find($id);
        $user->status = "Active";
        $user->save();
        return $user;
    }
    // public function edit($id, array $payload)
    // {
    //     $user = User::find($id);
    //     return $user->update($payload);
    // }

    public function getById($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function get($search)
    {
        if (!empty($search)) {
            return User::where('id', $search)
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->paginate(3);
        }
        return User::paginate(3);
    }

    public function getDepartment($department_id)
    {
        return User::where('department_id', $department_id)->get();;
    }

    public function search($search)
    {
        return User::where('id', $search)
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->get();
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
    public function getEmailByPosition($department_id, $position)
    {
        $email = User::where('position', $position)
            ->where('department_id', $department_id)
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

    public function leaveDays($id)
    {
        $user = User::find($id);
        $user->leave_days = $user->leave_days + 1;
        $user->save();
    }
}

<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ContactService
{
    /**
     * Undocumented function
     *
     * @var Contact
     */
    protected $contact;
    /**
     * Undocumented function
     *
     * @var UserService
     */
    protected $userService;

    /**
     *@var CalendarService
     */
    protected $calendarService;

    /**
     *@var AssetsService
     */
    protected $assetsService;

    public function __construct(Contact $contact, UserService $userService, CalendarService $calendarService, AssetsService $assetsService)
    {
        $this->contact = $contact;
        $this->userService = $userService;
        $this->calendarService = $calendarService;
        $this->assetsService = $assetsService;
    }

    public function create($id, $request)
    {
        $contact = Contact::create([
            'user_id' => $id,
            'content' => $request->content,
            'type' => $request->type,
            'phone' => $request->phone,
            'project' => $request->project,
            'reason' => $request->reason,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'assets_id' => $request->assets_id,
            'status' => 1,
        ]);
        return $contact;
    }

    public function getContact($id)
    {
        $contacts = Contact::where('user_id', $id)->get();
        return $contacts;
    }

    public function getById($id)
    {
        $contact = Contact::find($id);
        return $contact;
    }

    // public function updateById($id, array $payload)
    // {
    //     $contact = Contact::find($id);
    //     $contact->update($payload);
    //     return $contact;
    // }

    public function edit($id, array $payload)
    {
        $contact = Contact::find($id);
        if ($contact === null) {
            return null;
        }
        $contact->update($payload);

        return $contact;
    }

    public function delete($id)
    {
        $contact = Contact::find($id);

        if ($contact === null) {
            return null;
        }
        return  $contact->delete();
    }


    public function userCreate($id)
    {
        $user_id = Contact::where('id', $id)->value('user_id');
        if ($user_id === null) {
            return null;
        }
        $user = $this->userService->getById($user_id);
        if ($user === null) {
            return null;
        }
        return $user->name;
    }

    public function get($department_id, $status)
    {
        $contacts = Contact::select('contacts.*')
            ->join('users', 'users.id', '=', 'contacts.user_id')
            ->where('contacts.status', $status)
            ->where('users.department_id', $department_id)
            ->get();

        foreach ($contacts as $contact) {
            $user = User::with('contacts')->find($contact->user_id);
            $contact->user_name = $user->name;
        }
        return $contacts;
    }

    public function handleRequest($newContact, $user, $month)
    {
        if ($newContact && $newContact->status === 3) {

            if ($newContact->content === 'days_on') {
                $user = $this->userService->getById($newContact->user_id);
                $daysOn = $this->userService->getTime($newContact->time_start, $newContact->time_end);

                if ($daysOn <= $user->leave_days) {

                    $payload = ['leave_days' => $user->leave_days - $daysOn, 'month' => $month];
                } else {
                    $payload = ['leave_days' => 0, 'flag' => round($user->leave_days - $daysOn, 1), 'month' => $month];
                }
            } elseif ($newContact->content === 'days_off') {
                $payload = [];
            } elseif ($newContact->content === 'special_take_leave') {
                $days = $this->userService->getTime($newContact->time_start, $newContact->time_end);
                $payload = ['flag' => round($days, 2), 'month' => $month];
            } elseif ($newContact->content === 'over_time') {
                $overTime = $this->userService->getTime($newContact->time_start, $newContact->time_end) * 1.5;
                $payload = ['flag' => round($overTime, 2), 'month' => $month];
            } elseif ($newContact->content === 'forgot_to_check') {
                $day = date('d', strtotime($newContact->time_start));
                $month = date('m', strtotime($newContact->time_start));
                $id = $newContact->user_id;
                $this->calendarService->updateRequest($id, $newContact->time_start, $newContact->time_end, $day, $month);
                $payload = [];
            } elseif ($newContact->content === 'device_recall') {
                $id = $newContact->assets_id;

                $assets = $this->assetsService->getById($id);
                $assets->user_id = null;
                $assets->save();
                $payload = [];
            }

            return $payload;
        }
    }
}

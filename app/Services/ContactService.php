<?php

namespace App\Services;

use App\Models\Contact;
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

    public function __construct(Contact $contact, UserService $userService, CalendarService $calendarService)
    {
        $this->contact = $contact;
        $this->userService = $userService;
        $this->calendarService = $calendarService;
    }

    public function ContactsCreate($id, $request)
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
            'status' => 1,
        ]);
        return $contact;
    }

    public function getContact($id)
    {
        $contacts = Contact::where('user_id', $id)->get();
        return $contacts;
    }

    public function getContactById($id)
    {
        $contact = Contact::find($id);
        return $contact;
    }

    public function updateContactById($id, array $payload)
    {
        $contact = Contact::find($id);
        $contact->update($payload);
        return $contact;
    }

    public function edit($id, array $payload)
    {
        $contact = Contact::find($id);

        $contact->update($payload);

        return $contact;
    }

    public function delete($id)
    {
        $contact = Contact::find($id);

        return  $contact->delete();
    }


    public function userCreate($id)
    {
        $user_id = Contact::where('id', $id)->value('user_id');
        $user = $this->userService->getUserById($user_id);
        return $user->name;
    }

    public function get($department, $status)
    {
        $contacts = Contact::select('contacts.*')
            ->join('users', 'users.id', '=', 'contacts.user_id')
            ->where('contacts.status', $status)
            ->where('users.department', $department)
            ->get();

        return $contacts;
    }

    public function handleRequest($newContact, $user, $month)
    {
        if ($newContact && $newContact->status === 3) {

            if ($newContact->content === 'days_on') {
                $user = $this->userService->getUserById($newContact->user_id);
                $daysOn = $this->userService->getTime($newContact->time_start, $newContact->time_end);

                if ($daysOn <= $user->leave_days) {

                    $payload = ['leave_days' => $user->leave_days - $daysOn, 'month' => $month];
                } else {
                    $payload = ['leave_days' => 0, 'flag' => round($user->leave_days - $daysOn, 1), 'month' => $month];
                }
            } elseif ($newContact->content === 'days_off') {
                $daysOff = $this->userService->getTime($newContact->time_start, $newContact->time_end);
                $payload = ['flag' => round(-$daysOff, 2), 'month' => $month];
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
            }

            return $payload;
        }
    }
}

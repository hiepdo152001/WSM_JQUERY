<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Notifications\RequestNotify;
use App\Notifications\StatusReqNotify;
use App\Services\CalendarService;
use App\Services\ContactService;
use App\Services\UserService;
use DateTime;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    /**
     *@var ContactService
     */
    protected $contacts;

    /**
     *@var UserService
     */
    protected $users;

    /**
     *@var CalendarService
     */
    protected $calendarService;
    public function __construct(ContactService $contacts, UserService $users, CalendarService $calendarService)
    {
        $this->contacts = $contacts;
        $this->users = $users;
        $this->calendarService = $calendarService;
    }

    public function ContactCreate(Request $request)
    {
        $user = $this->getCurrentLoggedIn();
        $id = $user->id;
        $contact = $this->contacts->ContactsCreate($id, $request);

        if ($contact === null) {
            return response()->json([
                'status' => false,
                'message' => 'create contact not success!'
            ], 404);
        }

        // $contact->email = $user->email;
        $department_id = $user->department_id;
        $position = "tld";
        $email = $this->users->getEmailByPosition($department_id, $position);
        if ($email === null) {
            return response()->json([], 404);
        }
        $toUser = $this->users->getUserByEmail($email);

        $toUser->notify(new RequestNotify($contact, $user));

        return response()->json([
            'status' => true,
            'message' => 'create contact successful!'
        ], 200);
    }

    public function getContact()
    {
        $user = $this->getCurrentLoggedIn();
        $requests = $this->contacts->getContact($user->id);

        if ($requests->count() === 0) {
            return response()->json([
                'status' => false,
                'message' => 'Not request!'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $requests,
        ], 200);
    }

    public function get($id)
    {
        $contact = $this->contacts->getContactById($id);
        if ($contact === null) {
            return response()->json([], 404);
        }
        return response()->json([
            $contact
        ], 200);
    }

    public function setStatusRequest($id, Request $request)
    {
        $user = $this->getCurrentLoggedIn();
        $contact = $this->contacts->getContactById($id);
        if ($contact === null) {
            return response()->json([
                'status' => false,
                'message' => 'id not found!'
            ], 404);
        }

        $newContact = $this->contacts->updateContactById($id, $request->all());

        if ($newContact->status === 3) {
            $times = new DateTime($newContact->time_start);
            $month = $times->format("m");

            $payload = $this->contacts->handleRequest($newContact, $user, $month);

            $newContact = $this->contacts->updateContactById($id, $payload);

            $this->users->editUser($contact->user_id, $payload);
        }

        $toUser = $this->users->getUserById($contact->user_id);

        $toUser->notify(new StatusReqNotify($newContact, $user));

        return response()->json([
            $newContact,
            $toUser
        ], 200);
    }

    public function getManager()
    {
        $user = $this->getCurrentLoggedIn();
        $department_id = $user->department_id;
        $position = "tld";

        $email = $this->users->getEmailByPosition($department_id, $position);
        if ($email === null) {
            return response()->json([
                'name' => ""
            ], 200);
        }
        $userMng = $this->users->getUserByEmail($email);

        return response()->json([
            'name' => $userMng->name
        ], 200);
    }


    public function getRequestStatus($type)
    {
        $user = $this->getCurrentLoggedIn();

        $statuses = [
            'pending' => 1,
            'confirmed' => 2,
            'approved' => 3,
            'declined' => 4,
            'canceled' => 5,
        ];
        $status = $statuses[$type] ?? 1;

        $department_id = $user->department_id;
        $requests = $this->contacts->get($department_id, $status);

        return response()->json([
            'data' => $requests,
        ], 200);
    }

    public function edit($id, Request $request)
    {
        $contact = $this->contacts->edit($id, $request->input());

        return response()->json([
            $contact
        ], 200);
    }

    public function delete($id)
    {
        $contact = $this->contacts->delete($id);
        if ($contact === null) {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    public function userCreate($id)
    {
        $user = $this->contacts->userCreate($id);
        return response()->json([
            $user
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Notifications\RequestNotify;
use App\Notifications\StatusReqNotify;
use App\Services\ContactService;
use App\Services\UserService;
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

    public function __construct(ContactService $contacts, UserService $users)
    {
        $this->contacts = $contacts;
        $this->users = $users;
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
        $department = $user->department;
        $position = "tld";
        $email = $this->users->getEmailByPosition($department, $position);

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

        if ($requests === null) {
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

        $newContact = $this->contacts->updateContactById($id, $request);

        $toUser = $this->users->getUserById($contact->user_id);

        if ($toUser === null) {
            return response()->json([
                'status' => false,
                'message' => 'update success!'
            ], 200);
        }

        $toUser->notify(new StatusReqNotify($newContact, $user));

        return response()->json([
            'status' => true,
            'message' => 'update success!'
        ], 200);
    }
    public function getManager()
    {
        $user = $this->getCurrentLoggedIn();
        $department = $user->department;
        $position = "tld";
        $email = $this->users->getEmailByPosition($department, $position);
        $usermng = $this->users->getUserByEmail($email);
        return response()->json([
            'name' => $usermng->name
        ]);
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

        $user_id = $user->id;
        $requests = $this->contacts->getContactByStatus($user_id, $status);

        return response()->json([
            'data' => $requests,
        ], 200);
    }
}

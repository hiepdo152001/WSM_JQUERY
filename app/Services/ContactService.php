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
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
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
    public function updateContactById($id, $payload)
    {
        $contact = Contact::find($id);
        $contact->status = $payload->status;
        $contact->save();
        return $contact;
    }
}
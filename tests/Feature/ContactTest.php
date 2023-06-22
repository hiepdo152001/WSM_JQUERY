<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Notification;
use Tests\TestCase;

class ContactTest extends TestCase
{

    use DatabaseTransactions;
    private $token;
    private $user;
    private $contact;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken("API TOKEN")->plainTextToken;
        $this->contact = Contact::factory()->create();
        $this->contact->user_id = $this->user->id;
        $this->contact->save();
    }

    public function test_create_request_false_login()
    {
        $token = '';
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/users/requests', $this->contact->toArray());
        $res->assertStatus(500);
    }

    public function test_create_request_false_not_found_tld()
    {
        $user = User::factory()->create();
        $user->department_id = 1;
        $user->position = 'dd';
        $user->save();
        $token = $user->createToken("API TOKEN")->plainTextToken;
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/users/requests', $this->contact->toArray());
        $res->assertStatus(404);
    }

    public function test_create_request_done()
    {

        Notification::fake();

        $contactTo = Contact::find($this->contact->id);
        $userTo = User::find($this->contact->user_id);
        $userTo->department_id = 1;
        $userTo->position = 'tld';
        $userTo->save();
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->post('/api/users/requests', $this->contact->toArray());
        $userTo->notify((new \App\Notifications\StatusReqNotify($contactTo, $userTo)));
        Notification::assertSentTo($userTo, \App\Notifications\StatusReqNotify::class);
        $res->assertStatus(200);
    }

    public function test_get_request_false_login()
    {
        $token = '';
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/requests/all');

        $res->assertStatus(500);
    }

    public function test_get_request_null_record()
    {
        $this->contact->user_id = null;
        $this->contact->save();
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/requests/all');

        $res->assertStatus(404);
    }

    public function test_get_request_done()
    {
        $contact = Contact::factory()->create();
        $contact->user_id = $this->user->id;
        $contact->save();
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/requests/all');

        $res->assertStatus(200);
    }

    public function test_get_contact_false_login()
    {
        $token = '';
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/requests/999');

        $res->assertStatus(500);
    }

    public function test_get_contact_not_found_id()
    {
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/requests/999');

        $res->assertStatus(404);
    }

    public function test_get_contact_done()
    {
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/requests/1');

        $res->assertStatus(200);
    }

    public function  test_set_stt_request_false_login()
    {
        $token = '';
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->put('/api/users/requests/1', ['status' => 2]);

        $res->assertStatus(500);
    }

    public function  test_set_stt_false_not_found_id()
    {

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->put('/api/users/requests/999', ['status' => 2]);

        $res->assertStatus(404);
    }

    public function  test_set_stt_done_with_stt_deferent_3()
    {
        Notification::fake();

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->put('/api/users/requests/1', ['status' => 2]);
        $contactTo = Contact::find($this->contact['id']);
        $userTo = User::find($this->contact['user_id']);

        $userTo->notify((new \App\Notifications\StatusReqNotify($contactTo, $userTo)));
        $res->assertStatus(200);
        Notification::assertSentTo($userTo, \App\Notifications\StatusReqNotify::class);
    }

    public function test_delete_contact_false_login()
    {
        $token = "";
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/users/requests/1');
        $res->assertStatus(500);
    }

    public function test_delete_contact_not_record()
    {
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->delete('/api/users/requests/999');
        $res->assertStatus(404);
    }

    public function test_delete_contact_done()
    {
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->delete('/api/users/requests/' . $this->contact->id);
        $res->assertStatus(200);
    }
}

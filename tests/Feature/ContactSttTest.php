<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Notification;
use Tests\TestCase;

class ContactSttTest extends TestCase
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
    public function test_set_stt_3_content_day_on_with_days_on_greater_leave_days()
    {
        Notification::fake();
        $this->contact->time_start = "2023-06-09 05:00:01";
        $this->contact->time_end = "2023-06-12 12:59:01";
        $this->contact->content = "days_on";
        $this->contact->save();
        $this->user->leave_days = 2;
        $this->user->save();
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->put('/api/users/request/update/' . $this->contact->id, ['status' => 3]);
        $data = $res->json();
        $contact = $data[0];
        $flag = $contact['flag'];
        $status = $contact['status'];
        $user = $data[1];
        $leave_days = $user['leave_days'];

        $contactTo = Contact::find($contact['id']);
        $userTo = User::find($contact['user_id']);

        $userTo->notify((new \App\Notifications\StatusReqNotify($contactTo, $userTo)));
        $res->assertStatus(200);
        $this->assertEquals(3, $status);
        $this->assertEquals(-1.4, $flag);
        $this->assertEquals(0, $leave_days);
        Notification::assertSentTo($userTo, \App\Notifications\StatusReqNotify::class);
    }

    public function test_set_stt_3_content_day_on_with_days_on_less_leave_days()
    {
        Notification::fake();

        $this->contact->time_start = "2023-06-09 05:00:01";
        $this->contact->time_end = "2023-06-10 12:59:01";
        $this->contact->content = "days_on";
        $this->contact->save();
        $this->user->leave_days = 2;
        $this->user->save();

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->put('/api/users/request/update/' . $this->contact->id, ['status' => 3]);

        $data = $res->json();
        $contact = $data[0];
        $flag = $contact['flag'];

        $status = $contact['status'];
        $user = $data[1];
        $leave_days = $user['leave_days'];

        $contactTo = Contact::find($contact['id']);
        $userTo = User::find($contact['user_id']);
        $userTo->notify((new \App\Notifications\StatusReqNotify($contactTo, $userTo)));

        // Assert
        $res->assertStatus(200);
        $this->assertEquals(3, $status);
        $this->assertEquals(null, $flag);
        $this->assertEquals(0.6, $leave_days);

        Notification::assertSentTo($userTo, \App\Notifications\StatusReqNotify::class);
    }

    public function test_set_stt_3_content_day_off()
    {
        Notification::fake();
        $this->contact->time_start = "2023-06-09 05:00:01";
        $this->contact->time_end = "2023-06-10 12:59:01";
        $this->contact->content = "days_off";
        $this->contact->save();
        $this->user->leave_days = 2;
        $this->user->save();

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->put('/api/users/request/update/' . $this->contact->id, ['status' => 3]);

        $data = $res->json();
        $contact = $data[0];
        $flag = $contact['flag'];
        $status = $contact['status'];
        $user = $data[1];
        $leave_days = $user['leave_days'];

        $contactTo = Contact::find($contact['id']);
        $userTo = User::find($contact['user_id']);

        $userTo->notify((new \App\Notifications\StatusReqNotify($contactTo, $userTo)));

        Notification::assertSentTo($userTo, \App\Notifications\StatusReqNotify::class);
        $res->assertStatus(200);
        $this->assertEquals(3, $status);
    }

    public function test_stt_3_over_time()
    {

        Notification::fake();

        $this->contact->time_start = "2023-06-09 05:00:01";
        $this->contact->time_end = "2023-06-10 12:59:01";
        $this->contact->content = "over_time";
        $this->contact->save();
        $this->user->leave_days = 2;
        $this->user->save();

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->put('/api/users/request/update/' . $this->contact->id, ['status' => 3]);

        $data = $res->json();
        $contact = $data[0];
        $flag = $contact['flag'];
        $status = $contact['status'];
        $user = $data[1];
        $leave_days = $user['leave_days'];
        $contactTo = Contact::find($contact['id']);
        $userTo = User::find($contact['user_id']);

        $userTo->notify((new \App\Notifications\StatusReqNotify($contactTo, $userTo)));
        Notification::assertSentTo($userTo, \App\Notifications\StatusReqNotify::class);

        $res->assertStatus(200);
        $this->assertEquals(3, $status);
        $this->assertEquals(2.1, $flag);
        $this->assertEquals(2, $leave_days);
    }

    public function test_stt_3_with_special_take_leave()
    {
        Notification::fake();

        $this->contact->time_start = "2023-06-09 05:00:01";
        $this->contact->time_end = "2023-06-10 12:59:01";
        $this->contact->content = "special_take_leave";
        $this->contact->save();
        $this->user->leave_days = 2;
        $this->user->save();

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->put('/api/users/request/update/' . $this->contact->id, ['status' => 3]);

        $data = $res->json();
        $contact = $data[0];

        $flag = $contact['flag'];
        $status = $contact['status'];
        $user = $data[1];
        $leave_days = $user['leave_days'];

        $contactTo = Contact::find($contact['id']);
        $userTo = User::find($contact['user_id']);
        $userTo->notify((new \App\Notifications\StatusReqNotify($contactTo, $userTo)));

        Notification::assertSentTo($userTo, \App\Notifications\StatusReqNotify::class);
        $res->assertStatus(200);
        $this->assertEquals(3, $status);
        $this->assertEquals(1.4, $flag);
        $this->assertEquals(2, $leave_days);
    }
}

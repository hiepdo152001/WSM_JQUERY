<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactPart2Test extends TestCase
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

    public function test_get_manager_false_login()
    {
        $token = '';
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/requests/manager', $this->contact->toArray());
        $res->assertStatus(500);
    }

    public function test_get_manager_done()
    {
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/requests/manager', $this->contact->toArray());
        $res->assertStatus(200);
    }

    public function test_get_request_stt_false_login()
    {
        $token = '';
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/requests/member/pending');
        $res->assertStatus(500);
    }

    public function test_get_request_stt_1_done()
    {
        $contactPending1 = Contact::factory()->create();

        $contactPending1->user_id = $this->user->id;
        $contactPending1->save();
        $type = "pending";
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/requests/member/' . $type);

        $data = $res->json();

        $data1 = $data['data'][0];
        $data2 = $data['data'][1];

        $res->assertStatus(200);
        $this->assertEquals($data1['status'], 1);
        $this->assertEquals($data2['status'], 1);

        $this->assertEquals($data1['user_id'], $this->user->id);
        $this->assertEquals($data2['user_id'], $this->user->id);
    }

    public function test_get_request_stt_2_done()
    {
        $contactPending1 = Contact::factory()->create();
        $contactPending2 = Contact::factory()->create();

        $contactPending1->user_id = $this->user->id;
        $contactPending2->user_id = $this->user->id;

        $contactPending1->status = 2;
        $contactPending2->status = 2;

        $contactPending1->save();
        $contactPending2->save();

        $type = "confirmed";
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/requests/member/' . $type);
        $data = $res->json();

        $data1 = $data['data'][0];
        $data2 = $data['data'][1];
        $res->assertStatus(200);
        $this->assertEquals($data1['status'], 2);
        $this->assertEquals($data2['status'], 2);
        $this->assertEquals($data1['user_id'], $this->user->id);
        $this->assertEquals($data2['user_id'], $this->user->id);
    }

    public function test_get_request_stt_3_done()
    {
        $contactPending1 = Contact::factory()->create();
        $contactPending2 = Contact::factory()->create();

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $contactPending1->user_id = $user1->id;
        $contactPending2->user_id = $user2->id;

        $contactPending1->status = 3;
        $contactPending2->status = 3;

        $contactPending1->save();
        $contactPending2->save();

        $type = "approved";
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/requests/member/' . $type);
        $data = $res->json();

        $data1 = $data['data'][0];
        $data2 = $data['data'][1];
        $res->assertStatus(200);
        $this->assertEquals($data1['status'], 3);
        $this->assertEquals($data2['status'], 3);

        $this->assertEquals($data1['user_id'], $user1->id);
        $this->assertEquals($data2['user_id'], $user2->id);
    }

    public function test_get_request_stt_4_done()
    {
        $contactPending1 = Contact::factory()->create();
        $contactPending2 = Contact::factory()->create();

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $contactPending1->user_id = $user1->id;
        $contactPending2->user_id = $user2->id;

        $contactPending1->status = 4;
        $contactPending2->status = 4;

        $contactPending1->save();
        $contactPending2->save();

        $type = "declined";
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/requests/member/' . $type);
        $data = $res->json();

        $data1 = $data['data'][0];
        $data2 = $data['data'][1];
        $res->assertStatus(200);
        $this->assertEquals($data1['status'], 4);
        $this->assertEquals($data2['status'], 4);

        $this->assertEquals($data1['user_id'], $user1->id);
        $this->assertEquals($data2['user_id'], $user2->id);
    }

    public function test_get_request_stt_5_done()
    {
        $contactPending1 = Contact::factory()->create();
        $contactPending2 = Contact::factory()->create();

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $contactPending1->user_id = $user1->id;
        $contactPending2->user_id = $user2->id;

        $contactPending1->status = 5;
        $contactPending2->status = 5;

        $contactPending1->save();
        $contactPending2->save();

        $type = "canceled";
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/requests/member/' . $type);
        $data = $res->json();

        $data1 = $data['data'][0];
        $data2 = $data['data'][1];
        $res->assertStatus(200);
        $this->assertEquals($data1['status'], 5);
        $this->assertEquals($data2['status'], 5);

        $this->assertEquals($data1['user_id'], $user1->id);
        $this->assertEquals($data2['user_id'], $user2->id);
    }
}

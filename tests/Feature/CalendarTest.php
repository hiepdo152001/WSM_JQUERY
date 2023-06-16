<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\Time_keep;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarTest extends TestCase
{
    use DatabaseTransactions;
    private $token;
    private $user;
    private $timeKeep;
    private $contact;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken("API TOKEN")->plainTextToken;
        $this->timeKeep = Time_keep::factory()->create();
        $this->contact = Contact::factory()->create();
    }
    public function test_create_time_keep_false_login()
    {
        $token = "";
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/time-keep/new');
        $res->assertStatus(500);
    }

    public function test_create_time_keep_done()
    {
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/time-keep/new');
        $data = $res->json();
        $res->assertStatus(200);
        $this->assertEquals($this->timeKeep->time_in, $data['time_in']);
        $this->assertEquals($this->timeKeep->day, $data['day']);
        $this->assertEquals($this->timeKeep->month, $data['month']);
    }

    public function test_update_time_keep_false_login()
    {
        $token = "";
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/time-keep/update');
        $res->assertStatus(500);
    }

    public function test_update_time_keep_done()
    {
        $this->timeKeep->user_id = $this->user->id;
        $this->timeKeep->save();

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/time-keep/update');

        $res->assertStatus(200);
    }

    public function test_get_time_keep_false_login()
    {
        $token = "";
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/time-keep/get');

        $res->assertStatus(500);
    }

    public function test_get_time_keep_done()
    {

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/time-keep/get');
        $res->assertStatus(200);
    }

    public function test_get_time_keep_by_day_false_login()
    {
        $token = "";
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/time-keep/getByDay');

        $res->assertStatus(500);
    }

    public function test_get_time_keep_by_day()
    {
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/time-keep/getByDay');
        $res->assertStatus(200);
    }

    public function test_get_work_time_false_login()
    {
        $token = "";
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/time-keep/getWorkTime');

        $res->assertStatus(500);
    }

    public function test_get_work_time_done()
    {
        $dateNow = date('Y-m-d H:i:s');
        $month_keep = date('m', strtotime('-1 month', strtotime($dateNow)));
        $this->timeKeep->user_id = $this->user->id;
        $this->timeKeep->month = $month_keep;
        $this->timeKeep->work_time = 1.5;
        $this->timeKeep->save();

        $this->contact->flag = 1;
        $this->contact->user_id = $this->user->id;
        $this->contact->month = $month_keep;
        $this->contact->save();

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/time-keep/getWorkTime');
        $data = $res->json();
        $res->assertStatus(200);
        $this->assertEquals($data, 2.5);
    }

    public function test_get_work_time_done_2()
    {

        $dateNow = date('Y-m-d H:i:s');
        $month_keep = date('m', strtotime('-1 month', strtotime($dateNow)));

        $timeKeep = Time_keep::factory()->create();
        $timeKeep->month = $month_keep;
        $timeKeep->user_id = $this->user->id;
        $timeKeep->work_time = 0.4;
        $timeKeep->save();

        $this->timeKeep->user_id = $this->user->id;
        $this->timeKeep->month = $month_keep;
        $this->timeKeep->work_time = 0.8;
        $this->timeKeep->save();

        $user2 = User::factory()->create();
        $this->contact->user_id = $user2->id;
        $this->contact->flag = 1;
        $this->contact->month = $month_keep;
        $this->contact->save();

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/time-keep/getWorkTime');
        $data = $res->json();

        $res->assertStatus(200);
        $this->assertEquals($data, 1.2);
    }
}

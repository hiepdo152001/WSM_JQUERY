<?php

namespace Tests\Feature;

use App\Models\Departments;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentsTest extends TestCase
{
    use DatabaseTransactions;
    private $token;
    private $user;
    private $departments;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken("API TOKEN")->plainTextToken;
        $this->departments = Departments::factory()->create();
    }
    public function test_create_department_false_login()
    {
        $token = '';
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/users/department/new', $this->departments->toArray());
        $res->assertStatus(500);
    }

    public function test_create_department_done()
    {

        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->post('/api/users/department/new', ['name' => 'name1']);
        $res->assertStatus(200);
    }

    public function test_get_department_false_login()
    {
        $token = '';
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/department/get');
        $res->assertStatus(500);
    }

    public function test_get_department_done()
    {
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/department/get', ['name' => 'name']);
        $res->assertStatus(200);
    }

    public function test_get_by_id_department_false_login()
    {
        $token = "";
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/users/department/get/' . $this->departments->id);
        $res->assertStatus(500);
    }
    public function test_get_by_id_department_done()
    {
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->get('/api/users/department/get/' . $this->departments->id);
        $res->assertStatus(200);
    }

    public function test_edit_department_false_login()
    {
        $token = "";
        $res = $this->withHeader('Authorization', 'Bearer ' . $token)->patch('/api/users/department/edit/' . $this->departments->id);
        $res->assertStatus(500);
    }
    public function test_edit_department_done()
    {
        $res = $this->withHeader('Authorization', 'Bearer ' . $this->token)->patch('/api/users/department/edit/' . $this->departments->id, ['name' => 'name']);
        $res->assertStatus(200);
    }
}

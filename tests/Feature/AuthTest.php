<?php

namespace Tests\Feature;

use App\Models\User;
use Artisan;
use Hash;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_RegisterUser_validate()
    {
        $response = $this->post('/api/auth/register', ['name' => 'test1', 'email' => 'hiepdv@gmail.com', 'password' => '12345']);
        $response->assertStatus(422);
    }

    public function test_RegisterUser_done()
    {
        $response = $this->post('/api/auth/register', ['name' => 'admin', 'email' => 'admin1@gmail.com', 'password' => '12345678']);
        $response->assertStatus(200)
            ->assertJson(['status' => true, 'message' => 'User Create Successfully']);
    }

    public function test_login_false_not_exist_email()
    {
        $response = $this->post(
            'api/auth/login',
            ['email' => 'dohiepp@gmail.comm', 'password' => '12345678']
        );
        $response->assertStatus(401)
            ->assertJson([
                'message' => 'email not found',
                'status' => false
            ]);
    }

    public function test_login_false_password_not_match()
    {
        $response = $this->post(
            'api/auth/login',
            ['email' => 'admin123@gmail.com', 'password' => '1234567']
        );
        $response->assertStatus(401);
    }

    public function test_login_done()
    {
        $response = $this->post(
            'api/auth/login',
            ['email' => 'admin@gmail.com', 'password' => '12345678']
        );
        $response->assertStatus(200);
    }

    public function test_can_a_user_logout()
    {
        $user = User::factory()->make();

        $this->actingAs($user)->get('api/auth/logout')
            ->assertStatus(200);
    }

    public function test_change_password_false_email()
    {
        $response = $this->put(
            'api/auth/change-password',
            ['email' => 'dohiepaaaa@gmail.com', 'old_password' => '12345678', 'new_password' => '123456']
        );
        $response->assertStatus(404);
    }

    public function test_change_password_false_old_password_not_match()
    {
        $response = $this->put(
            'api/auth/change-password',
            ['email' => 'admin123@gmail.com', 'old_password' => '1234567', 'new_password' => '123456']
        );
        $response->assertStatus(404);
    }

    public function test_change_password_done()
    {
        $response = $this->put(
            'api/auth/change-password',
            ['email' => 'admin@gmail.com', 'old_password' => '12345678', 'new_password' => '12345678']
        );
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'change password successful!'

            ]);
    }
}

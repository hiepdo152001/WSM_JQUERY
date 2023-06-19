<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Database\Factories\TokenFactory;
use Database\Factories\UsersFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    private $token;
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->token = $this->user->createToken("API TOKEN")->plainTextToken;
    }

    public function test_update_user_by_id_no_id()
    {

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)->put('/api/users/update/user/50', ['name' => 'abc', 'email' => 'testcase@gmail.com']);
        $response->assertStatus(404);
    }

    public function test_update_user_by_id_false_validate()
    {

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)->put('/api/users/update/user/' . $this->user->id, ['name' => '', 'email' => 'admin@gmail.com']);
        $response->assertStatus(422);
    }

    public function test_update_user_by_id_done()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)->put('/api/users/update/user/' . $this->user->id, ['name' => 'abc', 'email' => 'adminn@gmail.com']);
        $response->assertStatus(200);
    }

    public function test_get_user_by_id_false()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' .  $this->token)->get('/api/users/get-user/999');
        $response->assertStatus(404);
    }

    public function test_get_user_by_id_done()
    {

        $response = $this->withHeader('Authorization', 'Bearer ' .  $this->token)->get('/api/users/get-user/1');
        $response->assertStatus(202);
    }

    public function test_delete_user_by_id_false()
    {
        $response =  $this->withHeader('Authorization', 'Bearer ' .  $this->token)->put('/api/users/delete/users/999');
        $response->assertStatus(404);
    }

    public function test_delete_user_by_id_done()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' .  $this->token)->put('/api/users/delete/users/' . $this->user->id);
        $response->assertStatus(202);
    }

    public function test_my_account_false_token()
    {
        $token = 'false';
        $response = $this->withHeader('Authorization', 'Bearer ' .  $token)->get('/api/users/my-account', [
            'Authorization' => 'Bearer' . $token
        ]);
        $response->assertStatus(500);
    }

    public function test_my_account_done()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' .  $this->token)->get('/api/users/my-account');
        $response->assertStatus(200);
    }

    public function test_update_my_account_done()
    {

        $response = $this->withHeader('Authorization', 'Bearer ' .  $this->token)->put('/api/users/update/my-account', ['cccd' => '12345678']);
        $response->assertStatus(200);
    }

    public function test_update_my_account_false()
    {
        $token = '';
        $response = $this->withHeader('Authorization', 'Bearer ' .  $token)->put('/api/users/update/my-account', ['name' => 'abc', 'cccd' => 'abcd']);
        $response->assertStatus(500);
    }

    public function test_edit_avatar_false_login()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');
        $token = '';
        $response = $this->withHeader('Authorization', 'Bearer ' .  $token)->post('/api/users/update/avatar', ['image_data' => $file]);
        $response->assertStatus(500);
    }

    public function test_edit_avatar_false_validate_type_file()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->create('image.pdf');

        $response = $this->withHeader('Authorization', 'Bearer ' .  $this->token)->post('/api/users/update/avatar', ['image_data' => $file]);
        $response->assertStatus(422);
    }

    public function test_edit_avatar_done()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->create('image.jpg');

        $response = $this->withHeader('Authorization', 'Bearer ' .  $this->token)->post('/api/users/update/avatar', ['image_data' => $file]);
        $response->assertStatus(200);
    }
}

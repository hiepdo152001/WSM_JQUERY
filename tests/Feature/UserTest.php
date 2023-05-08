<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Dusk\Http\Controllers\UserController;
use Tests\TestCase;

class UserTest extends TestCase
{


  public function test_update_user_by_id_no_id()
  {
    $response = $this->put(' /api/users/update/user/9', ['name' => 'abc', 'email' => 'admin3@gmail.com']);
    $response->assertStatus(404);
  }

  public function test_update_user_by_id_false_validate()
  {
    $response = $this->put('/api/users/update/user/3', ['email' => 'hiep', 'cccd' => 'string']);
    $response->assertJson([
      'message' => 'validation error',
    ])
      ->assertStatus(422);
  }

  public function test_update_user_by_id_done()
  {
    $response = $this->put('/api/users/update/user/4', ['email' => 'hiepssdf@gmail.com', 'cccd' => 123456789]);
    $response->assertJson([
      'status' => true,
      'message' => 'update successful'
    ])
      ->assertStatus(200);
  }

  public function test_get_user_by_id_false()
  {
    $response = $this->get('/api/users/get-user/999');
    $response->assertStatus(404)
      ->assertJson([
        'message' => 'user_id not found',
      ]);
  }

  public function test_get_user_by_id_done()
  {
    $response = $this->get('/api/users/get-user/2');
    $response->assertStatus(202)
      ->assertJson([
        'data' => [
          'id' => 2,
          'department' => "d1",
          'position' => 'fresher',
          'email' => 'dohiep1@gmail.com',
          'name' => 'hiep',
          'phone' =>  868251223,
          'project' => 'wsm',
          'sex' => 'nam',
          'permanent_address' => 'bac giang',
          'seniority' => '',
          'contract' => '',
          'temporary_address' => '',
          'cccd' => '1234567890',
          'issued_by' => '',
          'personal_email' => 'hiep@gmai.com',
          'tax_code' => '32435',
          'leave_days' => 0,
          'use_property' => '',
          'avatar' => '',
        ]
      ]);
  }

  public function test_delete_user_by_id_false()
  {
    $response = $this->delete('/api/users/delete/users/999');
    $response->assertStatus(404)
      ->assertJson([
        'status' =>  false,
        'message' => 'user id not found',
      ]);
  }

  public function test_delete_user_by_id_done()
  {
    $response = $this->delete('/api/users/delete/users/2');
    $response->assertStatus(202)
      ->assertJson(['message' => 'delete user successful',])
      ->assertJson(
        [
          'user delete' => [
            'id' => 1,
            'department' => 'd1',
            'position' => 'fresher',
            'email' => 'dohiep@gmail.com',
            'name' => 'hiep',
            'phone' => 1234567890,
            'project' => 'wsm',
            'sex' => 'nam',
            'permanent_address' => 'bac giang',
            'seniority' => '',
            'contract' => '',
            'temporary_address' => '',
            'cccd' => '123456789',
            'issued_by' => '',
            'personal_email' => 'hiep@gmai.com',
            'tax_code' => '32435',
            'leave_days' => 0,
            'use_property' => '',
            'avatar' => '',
          ]
        ]
      );
  }

  public function test_my_account_false_token()
  {
    $token = 'lFMcWnzCWxzPF.....8UFj';
    $response = $this->get('/api/users/my-account', [
      'Authorization' => 'Bearer' . $token
    ]);
    $response->assertStatus(500);
  }

  public function test_my_account_done()
  {
    $token = '66|HD2h4160hCgaGnerX1HdpYVekMOnYtmSvsuTgv20';
    $response = $this->get('/api/users/my-account', [
      'Authorization' => 'Bearer ' . $token
    ]);
    $response->assertStatus(200)
      ->assertJsonFragment([
        'name' => 'newname',
        'email' => 'admin123@gmail.com'
      ]);
  }

  public function test_update_my_account_done()
  {
    $token = '66|HD2h4160hCgaGnerX1HdpYVekMOnYtmSvsuTgv20';
    $response = $this->put('/api/users/update/my-account',['cccd'=>'12345678' ], [
      'Authorization' => 'Bearer ' . $token,
    ]);
    $response->assertStatus(200)
             ->assertJson([
              'status' => true,
              'message' => 'update successful'
             ]);
  }
  public function test_update_my_account_false()
  {
    $token = '';
    $response = $this->put('/api/users/update/my-account',['name'=>'newname','cccd'=>'12345678' ], [
      'Authorization' => 'Bearer ' . $token,
    ]);
    $response->assertStatus(500)
             ->assertJson([
              'status' => false,
              'message' => 'user not found!'
             ]);
  }
 

}

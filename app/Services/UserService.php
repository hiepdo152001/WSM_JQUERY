<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createUser($request)
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }

    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }
    public function editUser($id, array $payload)
    {
        $user = User::find($id);
        return $user->update($payload);
    }

    public function getUserById($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function newPassword(string $email, string $password)
    {
        return $this->user->where('email', $email)->update([
            'password' => Hash::make($password)
        ]);
    }

    public function getEmailById($id)
    {
        $email = User::where('id', $id)->value('email');
        return $email;
    }
    public function getEmailByPosition($department, $position)
    {
        $email = User::where('position', $position)
            ->where('department', $department)
            ->value('email');

        return $email;
    }
}

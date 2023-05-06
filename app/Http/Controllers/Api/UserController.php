<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CustomException;
use App\Exceptions\TestException;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Exception;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function updateUserById($id, Request $userequest)
    {
        $validator = FacadesValidator::make($userequest->all(), [
            'email' => 'string|unique:users|email'
        ]);
        $user = $this->userService->getUserById($id);
        $email = $userequest->email;

        if ($user === null) {
            return response()->json([
                'status' =>  false,
                'message' => 'user_id not found',
            ], 404);
        }

        if ($user->email !== $email && $validator->fails()) {
            return response()->json([
                'message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $this->userService->editUser($id, $userequest->input());

        return response()->json([
            'status' => true,
            'message' => 'update successful'
        ], 200);
    }

    public function updateUserLoggedIn(Request $request)
    {
        try {
            $user = $this->getCurrentLoggedIn();
            if (isset($user)) {
                $this->userService->editUser($user->id, $request->input());
                return response()->json([
                    'status' => true,
                    'message' => 'update successful'
                ], 200);
            } else {
                abort(401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' =>  false,
                'message' => $th->getMessage(),
            ], 422);
        };
    }

    public function getUserById($id)
    {
        $user = $this->userService->getUserbyId($id);

        if ($user === null) {
            return response()->json([
                'status' =>  false,
                'message' => 'user_id not found',
            ], 404);
        }

        return response()->json([
            'data' => $user
        ], 202);
    }

    public function getUserLogin()
    {

        $user = $this->getCurrentLoggedIn();

        if (!isset($user)) {
            return response()->json([
                'message' => 'not found login '
            ], 500);
        }

        return response()->json([
            'data' => $user
        ], 200);
    }

    public function deleteUserById($id)
    {
        $user = $this->userService->getUserbyId($id);

        if ($user === null) {
            return response()->json([
                'status' =>  false,
                'message' => 'user id not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'delete user successful',
            'user delete' => $user,
        ], 202);
    }
}
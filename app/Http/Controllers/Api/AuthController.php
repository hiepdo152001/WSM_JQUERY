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
use App\Mail\MailRegitser;
use App\Notifications\RegisterNotify;
use Exception;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function registerAccount(RegisterRequest $request)
    {

        $user = $this->userService->createUser($request);
        $user->notify(new RegisterNotify($user));

        // queue mail
        // $userMail = $user->email;
        // Mail::to("{{$userMail}}")->queue(new MailRegitser($user));

        return response()->json([
            'status' =>  true,
            'message' => 'User Create Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }


    public function loginAuth(Request $request)
    {
        $email = $request->email;
        $user = $this->userService->getUserByEmail($email);
        if (!$user) {
            return response()->json([
                'message' => 'email not found',
                'status' => false
            ], 401);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'message' => 'password not match',
                'status' => false
            ], 401);
        }

        $user->tokens()->delete();
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'message' => 'login successful',
            'status' => true,
            'token' => $token
        ], 200)->cookie('api_token',  $token, 60 * 24);
    }


    public function logout()
    {
        $user = $this->getCurrentLoggedIn();
        if ($user) {
            $user->tokens()->delete();
        }
        $cookie = Cookie::forget('api_token');
        return response()->json([
            'status' => true,
            'message' => 'logout successful',
        ], 200)->withCookie($cookie);
    }


    public function changePassword(PasswordRequest $request)
    {
        $email = $request->email;
        $user = $this->userService->getUserByEmail($email);
        if ($user === null) {
            return response()->json([
                'status' => false,
                'message' => 'email not found!',
            ], 404);
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'old password not match!',
            ], 404);
        }

        $this->userService->newPassword($user->email, $request->new_password);

        return response()->json([
            'status' => true,
            'message' => 'change password successful!',
        ], 200);
    }
}

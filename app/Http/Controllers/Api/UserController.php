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
use App\Http\Traits\FileUploadTrait;
use Exception;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Symfony\Component\CssSelector\Node\FunctionNode;

class UserController extends Controller
{
    use FileUploadTrait;

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // update
    public function update($id, Request $userequest)
    {
        $validator = FacadesValidator::make($userequest->all(), [
            'email' => 'string|unique:users|email'
        ]);
        $user = $this->userService->getById($id);
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

        $this->userService->edit($id, $userequest->input());

        return response()->json([
            'status' => true,
            'message' => 'update successful'
        ], 200);
    }

    // updateProfile
    public function updateProfile(Request $request)
    {

        $user = $this->getCurrentLoggedIn();
        if ($user === null) {
            return response()->json([
                'status' => false,
                'message' => 'user not found!'
            ], 500);
        }
        $this->userService->edit($user->id, $request->except(['position', 'department_id']));

        return response()->json([
            'status' => true,
            'message' => 'update successful'
        ], 200);
    }

    // getById
    public function getById($id)
    {
        $user = $this->userService->getById($id);

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

    // profile
    public function profile()
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

    // delete
    public function delete($id)
    {
        $user = $this->userService->deActive($id);
        if ($user === null) {
            return response()->json([
                "message" => "user not found",
            ], 404);
        }
        return response()->json([$user], 202);
    }

    // active
    public function active($id)
    {
        $user = $this->userService->Active($id);
        if ($user === false) {
            return response()->json([
                "message" => "user not found",
            ], 404);
        }
        return response()->json([$user], 202);
    }

    public function editAvatar(Request $request)
    {
        $user = $this->getCurrentLoggedIn();
        $id = $user->id;
        if (isset($user)) {
            if ($request->file('image_data')) {
                $pathName = $this->getFilePath($request->file('image_data'), 'profile');
                if ($pathName === false) {
                    return response()->json([], 422);
                }
                $userUpdate =  $this->userService->edit($id, [
                    'avatar' => $pathName,
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Success',
                    'data' => $userUpdate
                ], 200);
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'Not success',
        ], 500);
    }

    public function get(Request $request)
    {
        $search = $request->input('search');
        $users = $this->userService->get($search);
        return response()->json([
            $users
        ], 200);
    }

    public function getByDepartment($department_id)
    {
        $users = $this->userService->getDepartment($department_id);
        return response()->json([
            $users
        ], 200);
    }

    public function search($search)
    {
        $users = $this->userService->search($search);
        return response()->json([
            $users
        ], 200);
    }
}

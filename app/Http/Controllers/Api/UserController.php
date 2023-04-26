<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this-> userservice = $userService;
    }

   

     /**
 * @OA\Post(
 *     path="/api/registerAuth",
 *     summary="Register User",
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         description="The name of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="email",
 *         in="query",
 *         description="The email of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="password",
 *         in="query",
 *         description="The password of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="false",
 *        
 *     ),
 * )
 */
 public function RegisterAccount(RegisterRequest $userequest)
    {
        try {
           
            $user = User::create([
                'email'=> $userequest->email,
                'name' => $userequest->name,
                'password' => Hash::make($userequest->password),
            ]);
            return response()->json([
                'status' =>  true,
                'message' => 'User Create Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' =>false,
                'message' => $th->getMessage()
            ], 422);
        }
    }

        /**
 * @OA\Put(
 *     path="/api/updateUser/{id}",
 *     summary="Update User",
 *     @OA\Parameter(
 *         name="id",
 *         in= "path",
 *         description="The id of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format= "int64",
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         description="The name of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *      @OA\Parameter(
 *         name="email",
 *         in="query",
 *         description="The email of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *      @OA\Parameter(
 *         name="position",
 *         in="query",
 *         description="The position of the user",
 *         
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *       @OA\Parameter(
 *         name="department",
 *         in="query",
 *         description="The department of the user",
 *        
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *        @OA\Parameter(
 *         name="age",
 *         in="query",
 *         description="The age of the user",
 *         
 *         @OA\Schema(
 *             type="date-time",
 *         )
 *     ),
 *         @OA\Parameter(
 *         name="location",
 *         in="query",
 *         description="The location of the user",
 *        
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *         @OA\Parameter(
 *         name="project",
 *         in="query",
 *         description="The project of the user",
 *         
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *          @OA\Parameter(
 *         name="sex",
 *         in="query",
 *         description="The sex of the user",
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *           @OA\Parameter(
 *         name="permanent_address",
 *         in="query",
 *         description="The permanent_address of the user",
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *             @OA\Parameter(
 *         name="seniority",
 *         in="query",
 *         description="The seniority of the user",
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *              @OA\Parameter(
 *         name="contract",
 *         in="query",
 *         description="The contract of the user",
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *              @OA\Parameter(
 *         name="temporary_address",
 *         in="query",
 *         description="The temporary_address of the user",
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),   
 *              @OA\Parameter(
 *         name="issued_by",
 *         in="query",
 *         description="The issued_by of the user",
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ), 
 *              @OA\Parameter(
 *         name="personal_email",
 *         in="query",
 *         description="The personal_email of the user",
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ), 
 *               @OA\Parameter(
 *         name="CCCD",
 *         in="query",
 *         description="The CCCD of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ), 
 *                @OA\Parameter(
 *         name="tax_code",
 *         in="query",
 *         description="The tax_code of the user",
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ), 
 *               @OA\Parameter(
 *         name="leave_days",
 *         in="query",
 *         description="The leave_days of the user",
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ), 
 *               @OA\Parameter(
 *         name="use_property",
 *         in="query",
 *         description="The use_property of the user",
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ), 
 *               @OA\Parameter(
 *         name="avatar",
 *         in="query",
 *         description="The avatar of the user",
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ), 
 *                @OA\Parameter(
 *         name="working_day",
 *         in="query",
 *         description="The working_day of the user",
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ), 
 *                @OA\Parameter(
 *         name="promotion_day",
 *         in="query",
 *         description="The promotion_day of the user",
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ), 
 *                 @OA\Parameter(
 *         name="date_range",
 *         in="query",
 *         description="The date_range of the user",
 *         @OA\Schema(
 *             type="integer",
 *         )
 *     ), 
 *     @OA\Response(
 *         response=204,
 *         description="OK",
 *         
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="false",
 *        
 *     ),
 * )
 */
    public function updateUserById($id,Request $userequest)
    {
        try {
           $user=$this->userservice->getUserbyId($id);
            if (isset($user)) {
                $this->userservice->editUser($user, $userequest->input());
                return response()->json([
                    'status' => true,
                    'message' => 'update successfull'
                ],200);
            } else {
                abort(401);
            }
            
        } catch(\Throwable $th) {
            return response()->json([
             'status' =>  false,
             'message' => $th->getMessage(),
            ], 422);
        };
    }
/** 
* @OA\Get(
 *     path="/api/getUser/{id}",
 *     summary="Get User",
 *     @OA\Parameter(
 *         name="id",
 *         in= "path",
 *         description="The id of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format= "int64",
 *         )
 *     ),
 *     @OA\Response(
 *         response=202,
 *         description="message: delete user successfull,user delete: {id: 7, email: a@123,  name: 123,...}",
 *         
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="status:false,message: Call to a member function first() on null",
 *        
 *     ),
 * )
 */
    public function getUserbyId($id)
    {
        try {
            $user=$this->userservice->getUserbyId($id);
            return response()->json([
               'data' => $user

            ],202);
        } catch(\Throwable $th) {
            return response()->json([
               'status' =>  false,
               'message' => $th->getMessage(),
              ], 404);
        };
    }
/**
 * @OA\Get(
 *     path="/api/getUserLoggin",
 *     summary="Get current logged-in user",
 *     description="Retrieve the information of the current logged-in user",
 *      @OA\Parameter(
 *       parameter="Authorization",
 *       description="Bearer Token",
 *       in="header",
 *       name="Authorization",
 *       required=true,
 *       @OA\Schema(
 *         type="string"
 *     ),
 * ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *        
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error",
 *        
 *     )
 * )
 */
    public function getUserLoggin()
    {
        try {
            $user=$this->getCurrentLoggedIn();
            if (isset($user)) {
                return response()->json([
                    'data' => $user
                 ],200);
            }
        } catch(\Throwable $th) {
            return response()->json([
               'status' =>  false,
               'message' => $th->getMessage(),
              ], 500);
        };
    }
/** 
* @OA\Delete(
 *     path="/api/deleteUser/{id}",
 *     summary="Delete User",
 *@OA\Parameter(
 *         name="id",
 *         in= "path",
 *         description="The id of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format= "int64",
 *         )
 *     ),
 *     @OA\Response(
 *         response=202,
 *         description="OK, message:delete user successfull,data: detail user,example : user: id=1,name=abc,...",
 *         
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="status:false,message: Call to a member function first() on null",
 *        
 *     ),
 * )
 */
    public function deleteUserById($id){
       try{
        $user=User::find($id);
        if(isset($user)){
        $user->delete();
        }
        return response()->json([
            'message' => 'delete user successfull',
            'user delete' => $user,
         ],202);

       }catch(\Throwable $th){
        return response()->json([
            'status' =>  false,
            'message' => $th->getMessage(),
           ], 404);
       }
    }
    /** 
* @OA\Post(
 *     path="/api/loggin",
 *     summary="Loggin User",
 *     @OA\Parameter(
 *         name="email",
 *         in= "query",
 *         description="The email of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *      @OA\Parameter(
 *         name="password",
 *         in= "query",
 *         description="The password of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             format= "password",
 *         )
 *     ),
 *     @OA\Response(
 *         response=202,
 *         description="message: loggin successfull,status: true",
 *         
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="status:false, message: email not isset,",
 *        
 *     ),
 *     
 * )
 */
    public function loggin(Request $registerRequest){
        try{
            $email=$registerRequest->email;
            $user=User::where('email',$email);
            if(!$user){
                    return response()->json([
                        'message' => 'email not isset',
                        'status' => false
                     ],500);
            }
            if(!Auth::attempt(['email' => $registerRequest->email, 'password' => $registerRequest->password])){
                return response()->json([
                    'message' => 'password not match',
                    'status' => false
                 ],404);
            }

            elseif(Auth::attempt(['email' => $registerRequest->email, 'password' => $registerRequest->password])){  
                return response()->json([
                    'message' => 'loggin successfull',
                    'status' => true,
                 ],200);
            }

        }catch(\Throwable $th){
            return response()->json([
                'status'=> false,
                'message' => $th->getMessage(),
            ],500);
        }

    }

   
/** 
* @OA\Get(
 *     path="/api/logout",
 *     summary="Logout User",
 *      @OA\Parameter(
 *       parameter="Authorization",
 *       description="Bearer Token",
 *       in="header",
 *       name="Authorization",
 *       required=true,
 *       @OA\Schema(
 *         type="string"
 *     ),
 * ),
 *     @OA\Response(
 *         response=200,
 *         description="status:true,  message: logout successfull",
 *         
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="status:false",
 *        
 *     ),
 * )
 */
    public function logout(){
    try {
        $user=$this->getCurrentLoggedIn();
        if($user){
            $user->tokens()->delete();
        }
        return response()->json([
            'status' => true,
            'message' => 'logout successfull'
        ],200);
    } catch(\Throwable $th) {
        return response()->json([
            'status'=> true,
            'message' => $th->getMessage(),
        ], 500);

    }
}
    /** 
* @OA\Post(
 *     path="/api/changePassword",
 *     summary="changePassword User",
 *      @OA\Parameter(
 *       parameter="Authorization",
 *       description="Bearer Token",
 *       in="header",
 *       name="Authorization",
 *       required=true,
 *       @OA\Schema(
 *         type="string"
 *     ),
 * ),
 *     @OA\Parameter(
 *         name="email",
 *         in= "query",
 *         description="The email of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *      @OA\Parameter(
 *         name="old_password",
 *         in= "query",
 *         description="The old_password of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             format= "password",
 *         )
 *     ),
 *      @OA\Parameter(
 *         name="new_password",
 *         in= "query",
 *         description="The new_password of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             format= "password",
 *         )
 *     ),
 
 *     @OA\Response(
 *         response=202,
 *         description="message: Success'",
 *         
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="status:false, message: Mật khẩu cũ không chính xác,",
 *        
 *     ),
 *  @OA\Response(
 *         response=500,
 *         description="status:false",
 *        
 *     ),
 *     
 * )
 */
public function changePassword(Request $request)
    {
        try {

            $user = $this->getCurrentLoggedIn();

            if (isset($user)) {
                if (!Hash::check($request->old_password, $user->password)) {
                    return response()->json([
                        'status' => 422,
                        'message' => 'Mật khẩu cũ không chính xác'
                    ], 422);
                }

                $this->userservice->newPassword($user->email, $request->new_password);
            } else {
                abort(401);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $user
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);

        }
    }

}



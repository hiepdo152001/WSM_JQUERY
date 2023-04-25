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
 *             format="email"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="password",
 *         in="query",
 *         description="The password of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             
 *             @OA\Schema(
 *                 required={"name","email","password"},
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                      maximum=255,
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                     format="email",
 *                      maximum=255,
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     format="password",
 *                     minimum = 8,
 *                     type="string",
 *                 ),
 *                 example={"name": "A van B", "email": "abc@gamil.com", "password":"1234Ab1234" }
 *             )
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
 *     path="/api/updateUser",
 *     summary="Update User",
            
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                      maximum=255,
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                     format="email",
 *                     maximum=255,
 *                 ),
 *                 @OA\Property(
 *                     property="position",            
 *                     maximum = 255,
 *                     type="string",
 *                 ),
 *                  @OA\Property(
 *                     property="department",                     
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                   @OA\Property(
 *                     property="age",                     
 *                     maximum=255,
 *                     type="string",
 *                     format ="date-time",
 *                 ),
 *                   @OA\Property(
 *                     property="location",                   
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                   @OA\Property(
 *                     property="project",                    
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                   @OA\Property(
 *                     property="sex",                    
 *                     maximum=3,
 *                     type="string",
 *                 ),
 *                   @OA\Property(
 *                     property="permanent_address",                   
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                   @OA\Property(
 *                     property="seniority",                   
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                   @OA\Property(
 *                     property="contract",
 *                     format="contract",
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                   @OA\Property(
 *                     property="temporary_address",                    
 *                     maximum=255,
 *                     type="string",
 *                     format="email",
 *                 ),
 *                   @OA\Property(
 *                     property="issued_by",
 *                     
 *                     maximum=255,
 *                     type="integer",
 *                 ),
 *                    @OA\Property(
 *                     property="personal_email",                   
 *                     maximum=255,
 *                     type="string",
 *                     format="email",
 *                 ),
 *                    @OA\Property(
 *                     property="CCCD",                    
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                    @OA\Property(
 *                     property="tax_code",                    
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                     @OA\Property(
 *                     property="leave_days",                    
 *                     maximum=100,
 *                     type="integer",
 *                 ),
 *                     @OA\Property(
 *                     property="use_property",                    
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                     @OA\Property(
 *                     property="avatar",                   
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                     @OA\Property(
 *                     property="working_day",                   
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                     @OA\Property(
 *                     property="promotion_day",                   
 *                     maximum=255,
 *                     type="string",
 *                 ),
 *                     @OA\Property(
 *                     property="date_range",                   
 *                     maximum=255,
 *                     type="string",
 *                     format ="date-time",
 *                 ),
 * 
 *                 example={"name": "A van B", "email": "abc@gamil.com","department":"devesion 1", }
 *             )
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
    public function updateUser(UserRequest $userequest)
    {
        try {
            $user=$this->getCurrentLoggedIn();
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
 *     operationId="getCurrentUser",
 *     security={{"bearerAuth": {}}},
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
        $user=User::find($id)->first();
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
 *@OA\Parameter(
 *         name="email",
 *         in= "query",
 *         description="The id of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             format= "email",
 *         )
 *     ),
 * *@OA\Parameter(
 *         name="password",
 *         in= "query",
 *         description="The id of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             format= "password",
 *         )
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             
 *             @OA\Schema(
 *                 required={"email","password"},
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                     format="email",
 *                      maximum=255,
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     format="password",
 *                     minimum = 8,
 *                     type="string",
 *                 ),
 *                 example={"email": "abc@gamil.com", "password":"1234Ab1234" }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=202,
 *         description="message: loggin successfull,status: true, token: 11|BIRyGlIxhLyBtG6xQFFfbMWwEVhZhm7yR5GYRdOk",
 *         
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="status:false, message: email not isset,",
 *        
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="status:false, message: password not match,",
 *        
 *     ),
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
public function changePassword(Request $request)
    {
        try {

            $user = $this->getCurrentLoggedIn();

            if (isset($user)) {
                if (!Hash::check($request->old_position, $user->position)) {
                    return response()->json([
                        'status' => 422,
                        'message' => 'Mật khẩu cũ không chính xác'
                    ], 422);
                }

                $this->userservice->newPassword($user->email, $request->new_position);
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



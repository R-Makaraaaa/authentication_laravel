<?php

namespace App\Http\Controllers;



use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed" // password confirmation
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->first();
            $response = [
                "status" => false,
                "message" => $errorMessage,
            ];
            return response()->json($response, 401);
        }

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        // response
        return response()->json([
           "status" => true,
           "message" => "User registered successfully",
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required"
        ]);
        if($validator->fails()){
            $errorMessage = $validator->errors()->first();
            $response = [
                "status" => false,
                "message" => $errorMessage
            ];
            return response()->json($response, 401);
        }

        // Check user by email
        $user = User::where("email", $request->email)->first();

        // Check user by password
        if(!empty($user)){
            if(Hash::check($request->password, $user->password)){
                // Login is ok
                $tokenInfo = $user->createToken("cairocoders-ednalan");
                $token =  $tokenInfo->plainTextToken; // Token value

                return response()->json([
                    "status"=>true,
                    "message"=>"Login successfully!",
                    "token"=>$token
                ]);
            }else{
                return response()->json([
                   "status"=>false,
                   "message"=>"Password didn't match."
                ]);
            }

        }else{
            return response()->json([
               "status"=> false,
               "message"=> "Invalid credentials"
            ]);
        }



    }

    // Profile (GET AUTH TOKEN)
    public function profile()
    {
        $userData = auth()->user();

        return response()->json([
            "status"=>true,
            "message"=>"Profile information",
            "data"=> $userData
        ]);
    }

    // Logged out (GET, Auth token)
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Successfully logged out'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function refreshToken()
    {
        $tokenInfo = request()->user()->createToken("newtokencairocoders-ednalan");
        $newToken = $tokenInfo->plainTextToken; // token value
        return response()->json([
            "status"=> true,
            "message"=> "Refresh token",
            "access_token"=>$newToken
        ]);
    }

}

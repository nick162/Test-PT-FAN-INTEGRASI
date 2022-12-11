<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Arr; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            "password" => 'required',
        ]);

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 200);
        } else{
            $credentials = request(['email', 'password']);
            // $credentials = Arr::add($credentials, 'status', 'aktif');
            if (!Auth::attempt($credentials)) {
                $respon = [
                        'status' => 'error',
                        'msg' => 'Unathorized',
                        'errors' => null,
                        'content' => null,
                ];
                return response()->json($respon, 401);
            }
            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
               throw new Exception("Error in login");
            }
            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'status_code' => 200,
                'success' => true,
                'data' => [
                    'nama' => $request->user()->nama,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user_id' =>$request->user()->id,
                ]
            ];
            return response()->json($respon, 200);
        }

    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                // account
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'password_confirmation' => 'required',

                // umkm
                'business_name' => 'required|string|max:255',
                // 'user_id' => 'required',
                'category_id' => 'required',
                'phone' => 'required|numeric',
                'address' => 'required|string',
                'founded_at' => 'required',
                'social_media1' => 'string',
                'social_media2' => 'string',
                'social_media3' => 'string',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'role' => 'user',
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);


            $umkm = new BusinessProfile();
            $umkm->business_name = $request->business_name;
            $umkm->category_id = $request->category_id;
            $umkm->founded_at = $request->founded_at;
            $umkm->phone = $request->phone;
            $umkm->address = $request->address;
            $umkm->social_media1 = $request->social_media1;
            $umkm->social_media2 = $request->social_media2;
            $umkm->social_media3 = $request->social_media3;
            $user->businessProfile()->save($umkm);

            event(new Registered($user));

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'new user registration is successful, email verification link has been sent.',
                'token' => $user->createToken("register-token")->plainTextToken,
                'emailIsVerified' => request()->user()->hasVerifiedEmail()
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email|string',
                    'password' => 'required|string'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'email & password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            return response()->json([
                'status' => true,
                'message' => 'user logged in successfully',
                'token' => $user->createToken("login-token")->plainTextToken,
                'emailIsVerified' => request()->user()->hasVerifiedEmail()
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => 'you have logged out'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
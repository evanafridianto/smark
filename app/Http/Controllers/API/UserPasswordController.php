<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;

class UserPasswordController extends Controller
{
    public function passwordResetLink(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email|string',
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status == Password::RESET_LINK_SENT) {
                return response()->json([
                    'status' => true,
                    'message' =>  __($status),
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'token' => 'required',
                'email' => 'required|email',
                'password' => ['required', 'confirmed|', Rules\Password::defaults()],
                'password_confirmation' => 'required'
            ]
        );

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validate->errors()
            ], 401);
        }

        DB::beginTransaction();
        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status == Password::PASSWORD_RESET) {
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' =>  __($status),
                ], 200);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'current_password' => 'required|current_password',
                'password' => ['required', Rules\Password::defaults(), 'confirmed'],
                'password_confirmation' => 'required',
            ]
        );

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validate->errors()
            ], 401);
        }

        DB::beginTransaction();
        try {
            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'password updated successfully.',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
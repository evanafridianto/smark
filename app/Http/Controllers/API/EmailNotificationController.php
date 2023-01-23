<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailNotificationController extends Controller
{
    public function sendLink(Request $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) {
                return response()->json([
                    'status' => true,
                    'message' => 'email has been verified'
                ], 200);
            }
            $request->user()->sendEmailVerificationNotification();
            return response()->json([
                'status' => true,
                'message' => 'verification link sent'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
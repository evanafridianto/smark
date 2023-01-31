<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SmarkApi;
use Notification;

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
            // $request->user()->sendEmailVerificationNotification();

            $offerData = [
                'body' => $request->route('token')
            ];

            Notification::send($request->user(), new SmarkApi($offerData));

            return response()->json([
                'status' => true,
                'message' => 'verification link sent',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
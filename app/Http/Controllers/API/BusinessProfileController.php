<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class BusinessProfileController extends Controller
{
    public function show(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'data' => $request->user()->businessProfile,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
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

            $request->user()->businessProfile()->update([
                'business_name' => $request->business_name,
                // 'user_id' => 'required',
                'category_id' => $request->category_id,
                'phone' => $request->phone,
                'address' => $request->address,
                'founded_at' => $request->founded_at,
                'social_media1' => $request->social_media1,
                'social_media2' => $request->social_media2,
                'social_media3' => $request->social_media3,
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'business profile updated successfully.',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function businessCategory()
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Category::orderBy('name', 'ASC')->get(['id', 'name', 'description']),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
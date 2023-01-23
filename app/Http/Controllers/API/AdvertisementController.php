<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdvertisementController extends Controller
{
    public function index(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Advertisement::latest()->where('business_profile_id', $request->user()->businessProfile->id)->filter(request(['start_date', 'end_date']))->get(),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getById($id)
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Advertisement::find($id)
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'start_date' => 'required',
                'end_date' => 'required',
                'media' => 'required',
                'cost' => 'required|numeric',
                'description' => 'string|max:255',
                // 'status' => 'required',
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
            $ads = new Advertisement();
            $ads->business_profile_id = $request->user()->businessProfile->id;
            $ads->start_date = $request->start_date;
            $ads->end_date = $request->end_date;
            $ads->media = $request->media;
            $ads->cost = $request->cost;
            $ads->status = $request->status;
            $ads->description = $request->description;
            $ads->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'advertisement created.',
            ], 200);
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

        $ads = Advertisement::find($request->id);
        // $this->authorize('update', $ads);
        $validate = Validator::make(
            $request->all(),
            [
                'start_date' => 'required',
                'end_date' => 'required',
                'media' => 'required',
                'cost' => 'required|numeric',
                'description' => 'string|max:255',
                // 'status' => 'required',
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

            $ads->business_profile_id = $request->user()->businessProfile->id;
            $ads->start_date = $request->start_date;
            $ads->end_date = $request->end_date;
            $ads->media = $request->media;
            $ads->cost = $request->cost;
            $ads->status = $request->status;
            $ads->description = $request->description;
            $ads->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'advertisement updated.',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $ads = Advertisement::findOrFail($id);
        // $this->authorize('destroy', $ads);
        try {
            $ads->delete();
            return response()->json([
                'status' => true,
                'message' => 'advertisement deleted'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
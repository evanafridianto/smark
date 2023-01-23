<?php

namespace App\Http\Controllers\API;

use App\Models\Roas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Validator;

class RoasController extends Controller
{
    public function index(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Roas::latest()->whereHas(
                    'advertisement',
                    fn ($q) =>
                    $q->where('business_profile_id', $request->user()->businessProfile->id)
                )->filter(request(['start_date', 'end_date']))->get(),

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
                'data' => Roas::find($id)
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
                'advertisement_id' => 'required',
                'revenue_campaign' => 'required|numeric',
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

            $ads = Advertisement::findOrFail($request->advertisement_id);
            $roasScore = $request->revenue_campaign / $ads->cost;

            $roas = new Roas();
            $roas->advertisement_id = $request->advertisement_id;
            $roas->revenue_campaign = $request->revenue_campaign;
            $roas->roas_score = $roasScore;
            // $roas->conclusion = $roasScore <= 0 ? 'Rugi' : 'Laba';
            $roas->conclusion = $roas->revenue_campaign > 3 * $ads->cost ? 'Laba' : 'Rugi';
            $roas->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'roas created.',
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

        $roas = Roas::find($request->id);
        // $this->authorize('update', $roas);
        $validate = Validator::make(
            $request->all(),
            [
                'advertisement_id' => 'required',
                'revenue_campaign' => 'required|numeric',
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

            $ads = Advertisement::findOrFail($request->advertisement_id);
            $roasScore = $request->revenue_campaign / $ads->cost;

            $roas->advertisement_id = $request->advertisement_id;
            $roas->revenue_campaign = $request->revenue_campaign;
            $roas->roas_score = $roasScore;
            $roas->conclusion = $roas->revenue_campaign > 3 * $ads->cost ? 'Laba' : 'Rugi';
            // $roas->conclusion = $roasScore <= 0 ? 'Rugi' : 'Laba';
            $roas->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'roas updated.',
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
        $roas = Roas::findOrFail($id);
        // $this->authorize('destroy', $roas);
        try {
            $roas->delete();
            return response()->json([
                'status' => true,
                'message' => 'roas deleted'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
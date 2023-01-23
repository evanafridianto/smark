<?php

namespace App\Http\Controllers\API;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SalesRecordController extends Controller

{
    public function index(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Sale::latest()->where('business_profile_id', $request->user()->businessProfile->id)->filter(request(['start_date', 'end_date']))->get(),
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
                'data' => Sale::find($id)
            ], 200);
        } catch (\Throwable $th) {
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
                'transaction_id' => 'required',
                'advertisement_id' => 'required',
                'date' => 'required|date',
                'customer' => 'string|max:255',
                'qty' => 'required|numeric',
                'total' => 'required',
                'status' => 'required',
                'handling' => 'required',
                'description' => 'string|max:255',

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
            $sales = new Sale();
            $sales->business_profile_id = $request->user()->businessProfile->id;
            $sales->advertisement_id = $request->advertisement_id;
            $sales->transaction_id = $request->transaction_id;
            $sales->date = $request->date;
            $sales->customer = $request->customer;
            $sales->qty = $request->qty;
            $sales->total = $request->total;
            $sales->handling = $request->handling;
            $sales->status = $request->status;
            $sales->description = $request->description;
            $sales->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'sales record created.',
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
        $sales = Sale::find($request->id);
        // $this->authorize('update', $sales);
        $validate = Validator::make(
            $request->all(),
            [
                'transaction_id' => 'required',
                'advertisement_id' => 'required',
                'date' => 'required|date',
                'customer' => 'string|max:255',
                'qty' => 'required|numeric',
                'total' => 'required',
                'status' => 'required',
                'handling' => 'required',
                'description' => 'string|max:255',
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

            $sales->business_profile_id = $request->user()->businessProfile->id;
            $sales->transaction_id = $request->transaction_id;
            $sales->advertisement_id = $request->advertisement_id;
            $sales->date = $request->date;
            $sales->customer = $request->customer;
            $sales->qty = $request->qty;
            $sales->total = $request->total;
            $sales->handling = $request->handling;
            $sales->status = $request->status;
            $sales->description = $request->description;
            $sales->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'sales record updated.',
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
        $sales = Sale::findOrFail($id);
        // $this->authorize('destroy', $sales);
        try {
            $sales->delete();
            return response()->json([
                'status' => true,
                'message' => 'sales deleted'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
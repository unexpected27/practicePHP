<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Bid::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,accepted,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $bid = Bid::create($validator->validated());

        return response()->json([
            'message' => 'Bid created successfully',
            'data' => $bid
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bid = Bid::find($id);

        if (!$bid) {
            return response()->json(['message' => 'Bid not found'], 404);
        }

        return response()->json($bid, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bid = Bid::find($id);

        if (!$bid) {
            return response()->json(['message' => 'Bid not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'amount' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|string|in:pending,accepted,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $bid->update($validator->validated());

        return response()->json([
            'message' => 'Bid updated successfully',
            'data' => $bid
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bid = Bid::find($id);

        if (!$bid) {
            return response()->json(['message' => 'Bid not found'], 404);
        }

        $bid->delete();

        return response()->json(['message' => 'Bid deleted successfully'], 200);
    }
}

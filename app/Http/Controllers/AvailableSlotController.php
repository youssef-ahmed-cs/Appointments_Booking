<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAvailableSlot;
use App\Http\Requests\UpdateAvailableSlot;
use App\Models\AvailableSlot;
use Illuminate\Http\Request;

class AvailableSlotController extends Controller
{
    public function index()
    {
        $available_slot = AvailableSlot::with('provider')->get();
        return response()->json([
            'message' => 'Available slots retrieved successfully',
            'available_slots' => $available_slot
        ], 200);
    }

    public function show($id){
        $available_slot = AvailableSlot::with('provider')->findOrFail($id);
        return response()->json([
            'message' => 'Available slot retrieved successfully',
            'available_slot' => $available_slot
        ], 200);
    }

    public function store(StoreAvailableSlot $request){
        $available_slot = AvailableSlot::create($request->validated());
        return response()->json([
            'message' => 'Available slot created successfully',
            'available_slot' => $available_slot
        ], 201);
    }

    public function destroy($id){
        $available_slot = AvailableSlot::findOrFail($id);
        $available_slot->delete();
        return response()->json([
            'message' => 'Available slot deleted successfully',
            'available_slot' => $available_slot
        ]);
    }
    public function update(UpdateAvailableSlot $request, $id)
    {
        $available_slot = AvailableSlot::findOrFail($id);
        $available_slot->update($request->validated());
        return response()->json([
            'message' => 'Available slot updated successfully',
            'available_slot' => $available_slot
        ]);
    }

    public function getByProvider($providerId)
    {
        $data = AvailableSlot::where('provider_id', $providerId)
            ->with('provider')
            ->get();
        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'No available slots found for this provider',
            ], 404);
        }
        return response()->json([
            'message' => 'Available slots retrieved successfully',
            'available_slots' => $data
        ], 200);
    }
}

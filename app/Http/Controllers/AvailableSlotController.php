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
        $available_slot = AvailableSlot::with('provider')->findOrFail($id);
        $available_slot->delete();
        return response()->json([
            'message' => 'Available slot deleted successfully',
            'available_slot' => $available_slot
        ]);
    }
    public function update(UpdateAvailableSlot $request){
        $available_slot = AvailableSlot::with('provider')->findOrFail($id);
        $available_slot->update();
        return response()->json([
            'message' => 'Available slot deleted successfully',
            'available_slot' => $available_slot
        ]);
    }
}

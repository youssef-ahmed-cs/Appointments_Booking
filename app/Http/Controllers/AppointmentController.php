<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use http\Env\Request;
use Illuminate\Http\Request as HttpRequest;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::with(['provider', 'client'])->get();
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->validated());
        return response()->json([
            'message' => 'Appointment created successfully',
            'appointment' => $appointment
        ], 201);
    }

    public function show($id)
    {
        return Appointment::with(['provider', 'client'])->findOrFail($id);
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json([
            'message' => 'Appointment deleted successfully'
        ], 200);
    }

    public function update(UpdateAppointmentRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->validated());
        return response()->json([
            'message' => 'Appointment updated successfully',
            'appointment' => $appointment
        ], 200);
    }
}

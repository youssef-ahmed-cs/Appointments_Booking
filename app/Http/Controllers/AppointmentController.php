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
        return Appointment::with(['provider', 'client'])->paginate(10);
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

    public function getByClientId( $id) // This method retrieves appointments by client ID
    {
        $data = Appointment::where('client_id', $id)->with('client')->get();
        return response()->json([
            'message' => 'Appointments retrieved successfully',
            'appointments' => $data
        ], 200);
    }

    public function getByProviderId($id) # This method retrieves appointments by provider ID
    {
        $data = Appointment::where('client_id', $id)->with('provider')->get();
        return response()->json([
            'message' => 'Appointments retrieved successfully',
            'appointments' => $data
        ], 200);
    }

    public function getByServiceId(string $id)
    {
        $data = Appointment::where('service_id', $id)
            ->with('service')
            ->get();
        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'No appointments found for this service',
            ], 404);
        }
        return response()->json([
            'message' => 'Appointments retrieved successfully',
            'appointments' => $data
        ], 200);
    }
}

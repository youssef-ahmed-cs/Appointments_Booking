<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateSreviceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json([
            'services' => $services
        ], 200);
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return response()->json([
            'service' => $service
        ], 200);
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->validated());
        return response()->json([
            'message' => 'Service created successfully',
            'service' => $service
        ], 201);
    }

    public function destroy($id){
        $service  = Service::findOrFail($id);
        $service->delete();
        return response()->json([
            'message' => 'Service deleted successfully'
        ], 200);
    }

    public function update(UpdateSreviceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());
        return response()->json([
            'message' => 'Service updated successfully',
            'service' => $service
        ], 200);
    }

    public function getServicesByProviderId($id)
    {
        $data = Service::where('provider_id', $id)->with('provider')->get();
        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'No services found for this provider'
            ], 404);
        }
        return response()->json([
            'message' => 'Services retrieved successfully',
            'services' => $data
        ],200);
    }
}

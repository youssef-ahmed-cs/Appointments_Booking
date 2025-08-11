<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'provider_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'sometimes|required|date',
            'start_time' => 'sometimes|required|date_format:H:i',
            'end_time' => 'sometimes|required|date_format:H:i|after:start_time',
            'status' => 'sometimes|required|in:pending,confirmed,cancelled,completed',
            'notes' => 'sometimes|nullable|string|max:255',
        ];
    }
}

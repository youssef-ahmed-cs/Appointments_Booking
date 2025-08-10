<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];


    public function client():belongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function provider():belongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function service():belongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}

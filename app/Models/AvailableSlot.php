<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailableSlot extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function provider(){
        return $this->belongsTo(User::class, 'provider_id');
    }
}

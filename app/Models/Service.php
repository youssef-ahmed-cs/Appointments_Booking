<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function provider(){
        return $this->belongsTo(User::class , 'provider_id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

}

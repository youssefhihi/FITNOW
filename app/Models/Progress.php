<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Progress extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = [
    'user_id',
    'weight',
    'height',
    'waist_line',
    'bicep_thickness',
    'pec_width',
    'performance',
    'additional_notes',
    'status'
];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}

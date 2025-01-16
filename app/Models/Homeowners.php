<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homeowners extends Model
{
    use HasFactory;

    protected $table = 'homeowner'; // Table name
    protected $fillable = [
        'user_id',
        'full_name',
        'national_id',
        'passport_number',
        'gender',
        'address',
        'city',
        'profession',
        'marital_status',
        'religion',
        'image',
        'nid_front_image',
        'nid_back_image',
    ];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

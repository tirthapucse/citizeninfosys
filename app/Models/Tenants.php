<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
    use HasFactory;

    protected $table = 'tenant'; // Explicitly specify the table name

    protected $fillable = [
        'user_id',
        'full_name',
        'image',
        'national_id',
        'nid_front_image',
        'nid_back_image',
        'passport_number',
        'phone',
        'gender',
        'user_type',
        'address',
        'city',
        'marital_status',
        'religion',
        'profession',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rent()
    {
        return $this->hasOne(Rents::class, 'tenant_id', 'id');
    }
}

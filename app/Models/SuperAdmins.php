<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdmins extends Model
{
    protected $table = 'superadmin'; // Table name
    protected $fillable = [
        'user_id',
        'name',
    ];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

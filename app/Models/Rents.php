<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rents extends Model
{
    // In Rents model
    protected $table = 'rent';
    protected $fillable = ['tenant_id', 'property_id', 'homeowner_id', 'status'];

    public function tenant()
    {
        return $this->belongsTo(Tenants::class, 'tenant_id');
    }

    public function property()
    {
        return $this->belongsTo(Properties::class, 'property_id');
    }

    public function homeowner()
    {
        return $this->belongsTo(Homeowners::class, 'homeowner_id');
    }
}

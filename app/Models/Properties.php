<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table = 'property';
    protected $fillable = [
        'homeowner_id',
        'building_name',
        'building_address',
        'building_image',
        'holding_number',
        'holding_tax_number',
        'google_map_link',
        'total_flat',
        'total_floor',
    ];
    public function homeowner()
    {
        return $this->belongsTo(Homeowners::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenants::class, 'property_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinCode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'office_name', 
        'pin_code',
        'office_type',
        'delivery_status',
        'division_name',
        'region_name',
        'circle_name',
        'district_name',
        'state_name',
    ];

}

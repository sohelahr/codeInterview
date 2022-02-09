<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportSummary extends Model
{
    protected $table = 'import_summary';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'import_type', 
        'import_status',
    ];

    public function getImportStatusAttribute($value)
    {
        switch($value)
        {
            case "0":
                return "In Progress";
            case "1":
                return "Completed";
            case "2":
                return "Failed";
            default :
                return 'N/A';   
        }
    }

}

<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class entity_name extends Model
{
    //use SoftDeletes;
    use HasFactory;

    public $table = 'db_name';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        // MODEL_ATTRIBUTES'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
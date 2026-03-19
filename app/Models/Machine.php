<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'machines';
    protected $primaryKey = 'machine_id';

    protected $fillable = [
        'machine_name',
        'product_type',
        'status',
        'code',
        'capacity_mode',
        'capacity_value',
        'location',
        'remark',
        'photo_path',
        'created_by',
        'updated_by',
    ];
}

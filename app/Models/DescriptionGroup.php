<?php

namespace App\Models;

use App\Concerns\HasCreatedUpdatedUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DescriptionGroup extends Model
{
    use HasFactory, HasCreatedUpdatedUsers, SoftDeletes;
    public $timestamps = true;
    public $table = 'mo_description_gps';
    protected $fillable = [
        'description_gp_id',
        'gp_name',
        'description_type',
        'panel_type',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_at',
    ];

    public $primaryKey = 'description_gp_id';

    /**
    * Get description type text
    *
    * @return string
    */
    public function getDescriptionTypeTextAttribute(): string
    {
        switch ($this->description_type) {
            case 1:
                return 'Income';
            case 2:
                return 'Expense';
            case 3:
                return 'Income/Expense';
            default:
                return '-';
        }
    }

    /**
     * Relationship with Description
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descriptions()
    {
        return $this->hasMany(Description::class, 'description_gp_id', 'description_gp_id');
    }
}

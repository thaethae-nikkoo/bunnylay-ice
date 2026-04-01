<?php

namespace App\Models;

use App\Concerns\HasCreatedUpdatedUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Description extends Model
{
    use HasFactory, HasCreatedUpdatedUsers, SoftDeletes;
    public $table = 'mo_descriptions';
    protected $fillable = [
        'description_id',
        'description_gp_id',
        'name',
        'panel_type',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_at',
    ];
    public $primaryKey = 'description_id';
    public $timestamps = true;

    /**
     * Relationship with DescriptionGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function descriptionGroup()
    {
        return $this->belongsTo(DescriptionGroup::class, 'description_gp_id', 'description_gp_id');
    }
}

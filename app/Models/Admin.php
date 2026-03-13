<?php

namespace App\Models;

use App\Concerns\HasCreatedUpdatedUsers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasFactory;
    use HasCreatedUpdatedUsers;
    use SoftDeletes;
    public $timestamps = true;
    protected $table = "m_admins";
    protected $primaryKey = "admin_id";
    protected $fillable = [
        'admin_id',
        'name',
        'username',
        'password',
        'phone',
        'role',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Get Roles Name
     *
     * @return null|bool|int|string
     */
    public function getRoleNameAttribute()
    {
        $roles = config('constants.role');
        return $roles[$this->role];
    }

    /**
     *  Get created admin
     *
     * @return BelongsTo
     */
    public function createdAdmin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by', 'admin_id');
    }

    /**
     *  Get updated admin
     *
     * @return BelongsTo
     */
    public function updatedAdmin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by', 'admin_id');
    }

    /**
     * check if the admin is superAdmin
     *
     * @return boolean
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role == config('constants.auth.admin') ? true : false;
    }
}

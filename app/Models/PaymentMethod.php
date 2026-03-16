<?php

namespace App\Models;

use App\Concerns\HasCreatedUpdatedUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, HasCreatedUpdatedUsers, SoftDeletes;
    public $table = 'payment_methods';
    protected $fillable = [
        'payment_method_id',
        'method_name',
        'account_type',
        'account_name',
        'account_no',
        'logo_path',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_at',
    ];
    public $primaryKey = 'payment_method_id';
    public $timestamps = true;

    /**
    * Get description type text
    *
    * @return string
    */
    public function getStatusColorAttribute(): string
    {
        return $this->status == config('constants.payment_method_status_key.active') ? 'green' : 'red';
    }

}

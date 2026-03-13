<?php

namespace App\Concerns;

trait HasCreatedUpdatedUsers
{
    /**
     * Boot the trait for a model.
     *
     * @return void
     */
    public static function bootHasCreatedUpdatedUsers()
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->created_by = auth()->id();
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->updated_by = auth()->id();
            }
        });
    }

    /**
     * Get the name of the "updated_by" column.
     *
     * @return string
     */
    public function getUpdatedByColumn(): string
    {
        return defined('static::UPDATED_BY') ? static::UPDATED_BY : 'updated_by';
    }
}

<?php

namespace DesignByCode\Realtor\Traits;

trait SluggableTrait
{
    protected $sluggableColumn = "name";

    public static function bootSluggableTrait()
    {
        parent::boot();

        static::creating(function ($model) {
           $model->slug = str_slug($model->name);
        });
    }
}

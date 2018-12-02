<?php

namespace DesignByCode\Realtor\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Property extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'reference',
        'full_address',
        'number',
        'street_name',
        'town',
        'city',
        'province',
        'country',
        'post_code',
        'lat',
        'lng',
        'price',
        'solemandate',
        'sold',
        'live'
    ];

    /**
     * [registerMediaCollections description]
     *
     * @return [type] [description]
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('property')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('card')
                    ->crop(Manipulations::CROP_CENTER, 300, 180)
                    ->optimize()
                    ->width(300)
                    ->height(180);

                $this->addMediaConversion('thumb')
                    ->crop(Manipulations::CROP_CENTER, 100, 100)
                    ->optimize()
                    ->width(100)
                    ->height(100);
            });
    }

}

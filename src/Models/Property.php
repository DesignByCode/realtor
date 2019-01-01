<?php

namespace DesignByCode\Realtor\Models;

use App\User;
use function dd;
use DesignByCode\Realtor\Http\Filters\Properties\PropertiesFilter;
use Designbycode\Tagger\Models\TaggableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Property
 * @package DesignByCode\Realtor\Models
 */
class Property extends Model implements HasMedia
{
    use HasMediaTrait, TaggableTrait;

    /**
     * @var array
     */
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
        'solemandate',
        'sold',
        'live'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function price(){
        return $this->hasOne(Price::class, 'property_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function features()
    {
        return $this->hasOne(Feature::class, 'property_id');
    }

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

        $this->addMediaCollection('property-vr')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('card')
                    ->optimize()
                    ->width(300);

                $this->addMediaConversion('thumb')
                    ->optimize()
                    ->width(100);
            });
    }

    public function scopeFilter(Builder $builder, $request, array $filters = [])
    {
        return (new PropertiesFilter($request))->add($filters)->filter($builder);
    }


}

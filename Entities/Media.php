<?php

namespace Modules\Mediapress\Entities;

use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Mediapress\Presenters\MediaPresenter;

class Media extends Model
{
    use Translatable, MediaRelation, PresentableTrait;

    protected $table = 'mediapress__media';
    public $translatedAttributes = ['title', 'slug', 'description'];
    protected $fillable = ['title', 'slug', 'description', 'media_type', 'media_desc', 'brand', 'settings', 'sorting', 'release_at', 'status'];

    protected $casts = [
        'status'     => 'int',
        'settings'   => 'object'
    ];

    protected $dates = ['release_at'];

    protected $presenter = MediaPresenter::class;

    public function setReleaseAtAttribute($value)
    {
        return $this->attributes['release_at'] = Carbon::parse($value);
    }

    public function getUrlAttribute()
    {
        return localize_trans_url(locale(), 'mediapress::routes.media.view', ['slug'=>$this->slug]);
    }
}

<?php

namespace Modules\Mediapress\Entities;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ["title", "slug", "ordering", "status"];
    protected $table = 'mediapress__brands';

    public function Media()
    {
        return $this->hasMany(Media::class);
    }

    public function getUrlAttribute()
    {
        return localize_trans_url(locale(), 'mediapress::routes.brand.slug', ['mediapressBrandSlug'=>$this->slug]);
    }
}

<?php

namespace Modules\Mediapress\Entities;

use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Category extends Model
{
    use Translatable, PresentableTrait;

    public $translatedAttributes = ['name', 'slug', 'meta_title', 'meta_description'];
    protected $fillable = ['name', 'slug', 'meta_title', 'meta_description', 'sitemap_frequency', 'sitemap_priority', 'updated_at', 'meta_robot_no_index', 'meta_robot_no_follow', 'ordering', 'status'];
    protected $table = 'mediapress__categories';
    protected $with = ['medias', 'translations'];

    public function medias()
    {
        return $this->hasMany(Media::class)->orderBy('created_at', 'desc');
    }

    public function getUrlAttribute()
    {
        return localize_trans_url(locale(), 'mediapress::routes.category.slug', ['mediapressCategory'=>$this->slug]);
    }

    public function getRobotsAttribute()
    {
        return $this->meta_robot_no_index.', '.$this->meta_robot_no_follow;
    }

    public static function boot()
    {
        parent::boot();
        static::updating(function ($category){
            $category->updated_at = Carbon::now();
        });
    }
}

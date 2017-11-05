<?php

namespace Modules\Mediapress\Entities;

use Illuminate\Database\Eloquent\Model;

class MediaTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug', 'description'];
    protected $table = 'mediapress__media_translations';
}

<?php

namespace Modules\Mediapress\Presenters;

use Modules\Core\Presenters\BasePresenter;
use Modules\Mediapress\Entities\Type;

class MediaPresenter extends BasePresenter
{
    protected $zone     = 'pressImage';
    protected $slug     = 'slug';
    protected $transKey = 'mediapress::routes.media.view';
    protected $routeKey = 'mediapress.media.view';

    public function media_image($width=400, $height=400, $mode='resize', $quality=70)
    {
        switch ($this->entity->media_type)
        {
            case 'news':
            case 'web':
                return $this->firstImage($width, $height, $mode, $quality);
                break;

            case 'tv':
                $media_path = "/assets/media/";
                $media_prefix = "media_press_video_";
                $media_image = $media_path.$media_prefix."{$this->entity->id}.jpg";
                $media_new_image = $media_path.$media_prefix."{$this->entity->id}_{$width}_{$height}.jpg";
                if(!\File::exists(public_path($media_image))) {
                    \Image::make(file_get_contents($this->entity->settings->video_image))->fit($width, $height)->save(public_path($media_new_image));
                    return $media_new_image;
                } else {
                    return $media_new_image;
                }
                break;
            default:
                return null;
        }
    }

    public function yearurl($slug = "")
    {
        return localize_trans_url(locale(), 'mediapress::routes.category.year', ['mediapressCategory' => $slug, 'year'=>$this->entity->years]);
    }

    public function media_type()
    {
        return app(Type::class)->get($this->entity->media_type);
    }
}
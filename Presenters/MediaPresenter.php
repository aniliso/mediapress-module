<?php

namespace Modules\Mediapress\Presenters;

use Modules\Core\Presenters\BasePresenter;

class MediaPresenter extends BasePresenter
{
    protected $zone     = 'pressImage';
    protected $slug     = 'slug';
    protected $transKey = 'mediapress::routes.media.view';
    protected $routeKey = 'mediapress.media.view';

    public function media_type()
    {
        switch ($this->entity->media_type)
        {
            case 'web':
                return trans('mediapress::media.select.media_type.web');
            break;
            case 'tv':
                return trans('mediapress::media.select.media_type.tv');
            break;
            case 'news':
                return trans('mediapress::media.select.media_type.news');
            break;
            default:
                return null;
        }
    }

    public function media_desc()
    {
        switch ($this->entity->media_type)
        {
            case 'tv':
                return $this->entity->settings->video_html;
                break;
            default:
                return null;
        }
    }

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
}
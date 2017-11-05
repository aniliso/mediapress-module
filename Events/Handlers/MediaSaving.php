<?php namespace Modules\Mediapress\Events\Handlers;

use DaveJamesMiller\Breadcrumbs\Exception;
use Embed\Embed;
use Modules\Mediapress\Entities\Media;

class MediaSaving
{
    /**
     * @var Media
     */
    private $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
        $this->checkMedia($media);
    }

    private function checkMedia(Media $media) {
        try {
            switch ($media->media_type)
            {
                case 'tv' && !is_null($media->media_desc):
                    $embed = Embed::create($media->media_desc);
                    $media->settings = [
                        'video_html' => $embed->getCode(),
                        'video_image' => $embed->getImage()
                    ];
                    $media->save();
                    break;
                default:
                    throw new Exception('Medya Tip ve içerik bulunamadı');
            }
        }
        catch (\Exception $exception)
        {
            $media->settings = null;
            $media->save();
        }
    }
}
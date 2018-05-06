<?php namespace Modules\Mediapress\Widgets;


use Modules\Mediapress\Repositories\MediaRepository;

class MediaPressWidget
{
    /**
     * @var MediaRepository
     */
    private $media;

    public function __construct(MediaRepository $media)
    {

        $this->media = $media;
    }

    public function category($limit=0, $view='category')
    {

    }
}
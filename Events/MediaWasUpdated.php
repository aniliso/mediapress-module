<?php

namespace Modules\Mediapress\Events;

use Modules\Mediapress\Entities\Media;
use Modules\Media\Contracts\StoringMedia;

class MediaWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Media
     */
    public $media;

    public function __construct(Media $media, array $data)
    {
        $this->data = $data;
        $this->media = $media;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->media;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}

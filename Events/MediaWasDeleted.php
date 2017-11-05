<?php

namespace Modules\Mediapress\Events;

use Modules\Media\Contracts\DeletingMedia;

class MediaWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $mediaClass;
    /**
     * @var int
     */
    private $mediaId;

    public function __construct($mediaId, $mediaClass)
    {
        $this->mediaClass = $mediaClass;
        $this->mediaId = $mediaId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->mediaId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->mediaClass;
    }
}

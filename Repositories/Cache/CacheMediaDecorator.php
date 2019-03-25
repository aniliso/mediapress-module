<?php

namespace Modules\Mediapress\Repositories\Cache;

use Modules\Mediapress\Repositories\MediaRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheMediaDecorator extends BaseCacheDecorator implements MediaRepository
{
    public function __construct(MediaRepository $media)
    {
        parent::__construct();
        $this->entityName = 'mediapress.media';
        $this->repository = $media;
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function findByType($type = '', $per_page = 10)
    {
        $page = \Request::has('page') ? \Request::query('page') : 1;
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.findByType.{$type}.{$per_page}.{$page}", $this->cacheTime,
                function () use ($type, $per_page) {
                    return $this->repository->findByType($type, $per_page);
                }
            );
    }
}

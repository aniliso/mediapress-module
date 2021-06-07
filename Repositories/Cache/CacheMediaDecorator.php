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
     * @param string $year
     * @param int $per_page
     * @return array|mixed
     */
    public function findByYear($year = '', $per_page = 10)
    {
        $page = \Request::has('page') ? \Request::query('page') : 1;
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.findByYear.{$year}.{$per_page}.{$page}", $this->cacheTime,
                function () use ($year, $per_page) {
                    return $this->repository->findByYear($year, $per_page);
                }
            );
    }

    public function findByCategoryYear($slug, $year, $per_page = 10)
    {
        $page = \Request::has('page') ? \Request::query('page') : 1;
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.findByCategoryYear.{$slug}.{$year}.{$per_page}.{$page}", $this->cacheTime,
                function () use ($slug, $year, $per_page) {
                    return $this->repository->findByCategoryYear($slug, $year, $per_page);
                }
            );
    }

    public function latest($limit = 6)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.latest.{$limit}", $this->cacheTime,
                function () use ($limit) {
                    return $this->repository->latest($limit);
                }
            );
    }

    public function findByBrand($brand = '', $per_page = 10)
    {
        $page = \Request::has('page') ? \Request::query('page') : 1;
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.findByBrand.{$brand}.{$per_page}.{$page}", $this->cacheTime,
                function () use ($brand, $per_page) {
                    return $this->repository->findByBrand($brand, $per_page);
                }
            );
    }


    /**
     * @param string $year
     * @param int $per_page
     * @return array|mixed
     */
    public function findByYearType($year = '', $type="", $per_page = 10)
    {
        $page = \Request::has('page') ? \Request::query('page') : 1;
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.findByYearType.{$year}.{$type}.{$per_page}.{$page}", $this->cacheTime,
                function () use ($year, $type, $per_page) {
                    return $this->repository->findByYearType($year, $type, $per_page);
                }
            );
    }


    public function findByCategoryYearByType($slug, $year, $type, $per_page = 10)
    {
        $page = \Request::has('page') ? \Request::query('page') : 1;
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.findByCategoryYearByType.{$slug}.{$year}.{$type}.{$per_page}.{$page}", $this->cacheTime,
                function () use ($slug, $year, $type, $per_page) {
                    return $this->repository->findByCategoryYearByType($slug, $year, $type, $per_page);
                }
            );
    }
}

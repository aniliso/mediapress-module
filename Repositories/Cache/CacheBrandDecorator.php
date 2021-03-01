<?php


namespace Modules\Mediapress\Repositories\Cache;

use Modules\Mediapress\Repositories\BrandRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBrandDecorator extends BaseCacheDecorator implements BrandRepository
{
    public function __construct(BrandRepository $brand)
    {
        parent::__construct();
        $this->entityName = 'mediapress.brands';
        $this->repository = $brand;
    }
}
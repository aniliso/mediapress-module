<?php


namespace Modules\Mediapress\Repositories\Cache;

use Modules\Mediapress\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'mediapress.categories';
        $this->repository = $category;
    }
}
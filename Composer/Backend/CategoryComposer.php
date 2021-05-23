<?php

namespace Modules\Mediapress\Composer\Backend;

use Modules\Mediapress\Entities\Status;
use Modules\Mediapress\Entities\Type;
use Modules\Mediapress\Repositories\BrandRepository;
use Modules\Mediapress\Repositories\CategoryRepository;
use Illuminate\Contracts\View\View;

class CategoryComposer
{
    /**
     * @var CategoryRepository
     */
    private $category;
    /**
     * @var BrandRepository
     */
    private $brand;
    /**
     * @var Status
     */
    private $status;
    /**
     * @var Type
     */
    private $type;

    public function __construct(CategoryRepository $category, BrandRepository $brand, Status $status, Type $type)
    {
        $this->category = $category;
        $this->brand = $brand;
        $this->status = $status;
        $this->type = $type;
    }

    public function compose(View $view)
    {
        $categories = $this->category->all()->where('status', 1)->pluck('name', 'id')->toArray();
        $brands     = $this->brand->all()->pluck('title', 'id')->toArray();
        $types      = $this->type->lists();
        $statuses   = $this->status->lists();
        $view->with('categoryLists', $categories)
             ->with('brandLists', $brands)
             ->with('statuses', $statuses)
             ->with('types', $types);
    }
}
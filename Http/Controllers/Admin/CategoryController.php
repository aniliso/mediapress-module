<?php

namespace Modules\Mediapress\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Mediapress\Entities\Category;
use Modules\Mediapress\Entities\Status;
use Modules\Mediapress\Http\Requests\StoreCategoryRequest;
use Modules\Mediapress\Http\Requests\UpdateCategoryRequest;
use Modules\Mediapress\Repositories\CategoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CategoryController extends AdminBaseController
{
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(CategoryRepository $category, Status $status)
    {
        parent::__construct();

        $this->category = $category;

        view()->share('statuses', $status->lists());
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->all();

        return view('mediapress::admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('mediapress::admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->category->create($request->all());

        return redirect()->route('admin.mediapress.category.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('mediapress::category.title.category')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('mediapress::admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category $category
     * @param  Request $request
     * @return Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->category->update($category, $request->all());

        return redirect()->route('admin.mediapress.category.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('mediapress::category.title.category')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $this->category->destroy($category);

        return redirect()->route('admin.mediapress.category.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('mediapress::category.title.category')]));
    }
}

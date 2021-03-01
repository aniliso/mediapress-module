<?php

namespace Modules\Mediapress\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Mediapress\Entities\Brand;
use Modules\Mediapress\Entities\Status;
use Modules\Mediapress\Http\Requests\StoreBrandRequest;
use Modules\Mediapress\Repositories\BrandRepository;

class BrandController extends AdminBaseController
{
    /**
     * @var BrandRepository
     */
    private $brand;

    public function __construct(
        Status $status,
        BrandRepository $brand
    )
    {
        parent::__construct();

        view()->share('statuses', $status->lists());
        $this->brand = $brand;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|Response|\Illuminate\View\View
     */
    public function index()
    {
        $brands = $this->brand->all();

        return view('mediapress::admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('mediapress::admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(StoreBrandRequest $request)
    {
        $this->brand->create($request->all());

        return redirect()->route('admin.mediapress.brand.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('mediapress::brand.title.brand')]));
    }

    /**
     * Show the specified resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|Response|\Illuminate\View\View
     */
    public function show()
    {
        return view('mediapress::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|Response|\Illuminate\View\View
     */
    public function edit(Brand $brand)
    {
        return view('mediapress::admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Brand $brand, Request $request)
    {
        $this->brand->update($brand, $request->all());

        return redirect()->route('admin.mediapress.brand.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('mediapress::brand.title.brand')]));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Brand $brand)
    {
        $this->brand->destroy($brand);

        return redirect()->route('admin.mediapress.brand.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('mediapress::brand.title.brand')]));
    }
}

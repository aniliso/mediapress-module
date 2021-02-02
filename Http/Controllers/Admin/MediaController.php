<?php

namespace Modules\Mediapress\Http\Controllers\Admin;

use Embed\Embed;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Mediapress\Entities\Media;
use Modules\Mediapress\Http\Requests\CreateMediaRequest;
use Modules\Mediapress\Http\Requests\UpdateMediaRequest;
use Modules\Mediapress\Repositories\CategoryRepository;
use Modules\Mediapress\Repositories\MediaRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class MediaController extends AdminBaseController
{
    /**
     * @var MediaRepository
     */
    private $media;
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(MediaRepository $media, CategoryRepository $category)
    {
        parent::__construct();

        $this->media = $media;
        $this->category = $category;

        view()->share('categoryLists', $this->category->all()->pluck('name', 'id')->toArray());
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $medias = $this->media->all();

        return view('mediapress::admin.media.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('mediapress::admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateMediaRequest $request
     * @return Response
     */
    public function store(CreateMediaRequest $request)
    {
        $this->media->create($request->all());

        return redirect()->route('admin.mediapress.media.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('mediapress::media.title.media')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Media $media
     * @return Response
     */
    public function edit(Media $media)
    {
        return view('mediapress::admin.media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Media $media
     * @param  UpdateMediaRequest $request
     * @return Response
     */
    public function update(Media $media, UpdateMediaRequest $request)
    {
        $this->media->update($media, $request->all());

        return redirect()->route('admin.mediapress.media.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('mediapress::media.title.media')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Media $media
     * @return Response
     */
    public function destroy(Media $media)
    {
        $this->media->destroy($media);

        return redirect()->route('admin.mediapress.media.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('mediapress::media.title.media')]));
    }
}
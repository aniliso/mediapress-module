<?php

namespace Modules\Mediapress\Http\Controllers;

use Breadcrumbs;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Mediapress\Entities\Media;
use Modules\Mediapress\Repositories\MediaRepository;

class PublicController extends BasePublicController
{
    /**
     * @var MediaRepository
     */
    private $media;

    public function __construct(MediaRepository $media)
    {
        parent::__construct();
        $this->media = $media;

        /* Start Default Breadcrumbs */
        if(!app()->runningInConsole()) {
            Breadcrumbs::register('mediapress.index', function ($breadcrumbs) {
                $breadcrumbs->push(trans('mediapress::mediapress.title.mediapress'), route('mediapress.media.index'));
            });
        }
        /* End Default Breadcrumbs */
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($category=null)
    {
        $medias = $this->media->findByType($category);

        $title = !is_null($category) ? app('mediaTypes')[$category] : trans('mediapress::mediapress.title.mediapress');
        $this->setTitle($title)
             ->setDescription($title);

        Breadcrumbs::register('mediapress.category', function ($breadcrumbs) use ($category) {
            $breadcrumbs->parent('mediapress.index');
            if(!is_null($category)) {
                $breadcrumbs->push(app('mediaTypes')[$category], route('mediapress.media.category', [$category]));
            }
        });

        return view('mediapress::index', compact('medias', 'category'));
    }

    public function view(Media $media)
    {
        $this->setTitle($media->title)
             ->setDescription(\Str::words($media->description, 10));

        Breadcrumbs::register('mediapress.view', function ($breadcrumbs) use ($media) {
            $breadcrumbs->parent('mediapress.index');
            $breadcrumbs->push(app('mediaTypes')[$media->media_type], route('mediapress.media.category', [$media->media_type]));
            $breadcrumbs->push($media->title, route('mediapress.media.view', [$media->slug]));
        });

        return view('mediapress::view', compact('media'));
    }
}
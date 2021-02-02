<?php

namespace Modules\Mediapress\Http\Controllers;

use Breadcrumbs;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Mediapress\Entities\Category;
use Modules\Mediapress\Entities\Media;
use Modules\Mediapress\Repositories\CategoryRepository;
use Modules\Mediapress\Repositories\MediaRepository;

class PublicController extends BasePublicController
{
    /**
     * @var MediaRepository
     */
    private $media;
    /**
     * @var CategoryRepository
     */
    private $category;
    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    private $per_page;

    public function __construct(MediaRepository $media, CategoryRepository $category)
    {
        parent::__construct();
        $this->media = $media;
        $this->category = $category;

        $this->per_page = config('asgard.mediapress.config.per_page', 10);

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
    public function index($year = "")
    {
        if($year) {
            $medias = $this->media->findByYear((int)$year, $this->per_page);
        } else {
            $medias = $this->media->paginate($this->per_page);
        }

        $this->setTitle(trans('mediapress::mediapress.title.mediapress'))
            ->setDescription(trans('mediapress::mediapress.title.mediapress'));

        return view('mediapress::index', compact('medias'));
    }

    public function view(Media $media)
    {
        if(!$media) return abort(404);

        $this->setTitle($media->title)
             ->setDescription(\Str::words($media->description, 10));

        Breadcrumbs::register('mediapress.view', function ($breadcrumbs) use ($media) {
            $breadcrumbs->parent('mediapress.index');
            $breadcrumbs->push($media->category->name, $media->category->url);
            $breadcrumbs->push($media->title, route('mediapress.media.view', [$media->slug]));
        });

        return view('mediapress::view', compact('media'));
    }

    public function category(Category $category)
    {
        if(!$category) return abort(404);

        $medias = $category->medias()->get();

        $this->setTitle($category->name)
            ->setDescription($category->name);

        Breadcrumbs::register('mediapress.category', function ($breadcrumbs) use ($category) {
            $breadcrumbs->parent('mediapress.index');
            $breadcrumbs->push($category->name, $category->url);
        });

        return view('mediapress::category', compact('category', 'medias'));
    }

    public function year(Category $category, $year = "")
    {
        $medias = $this->media->findByCategoryYear($category->slug, $year, $this->per_page);

        $this->setTitle($category->name . ' ' . $year)
            ->setDescription($category->name . ' '. $year);

        Breadcrumbs::register('mediapress.year', function ($breadcrumbs) use ($category, $year) {
            $breadcrumbs->parent('mediapress.index');
            $breadcrumbs->push($category->name, $category->url);
            $breadcrumbs->push($category->name . ' ' . $year);
        });

        return view('mediapress::year', compact('medias', 'category', 'year'));
    }
}

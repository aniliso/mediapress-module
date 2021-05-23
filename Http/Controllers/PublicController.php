<?php

namespace Modules\Mediapress\Http\Controllers;

use Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Mediapress\Entities\Brand;
use Modules\Mediapress\Entities\Category;
use Modules\Mediapress\Entities\Media;
use Modules\Mediapress\Entities\Type;
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
    /**
     * @var Type
     */
    private $type;

    public function __construct(MediaRepository $media, CategoryRepository $category, Type $type)
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
        $this->type = $type;
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|Response|\Illuminate\View\View
     */
    public function index()
    {

        $medias = $this->media->paginate($this->per_page);

        $this->setTitle(trans('mediapress::mediapress.title.mediapress'))
            ->setDescription(trans('mediapress::mediapress.title.mediapress'));

        return view('mediapress::index', compact('medias'));
    }

    public function year(Request $request)
    {
        $year = (int)$request->segment(3);
        $medias = $this->media->findByYear($year, $this->per_page);

        $title = trans('mediapress::mediapress.title.mediapress'). ' '. $year;

        $this->setTitle($title)
            ->setDescription($title);

        Breadcrumbs::register('mediapress.year', function ($breadcrumbs) use ($year) {
            $breadcrumbs->parent('mediapress.index');
            $breadcrumbs->push($year);
        });

        return view('mediapress::year', compact('medias', 'title', 'year'));
    }

    public function type(Request $request)
    {
        $year = (int)$request->segment(3);
        $type = $request->segment(4);

        $medias = $this->media->findByYearType($year, $type, $this->per_page);

        $title = $medias->first()->present()->media_type . ' ' . $year;

        $this->setTitle($title)
            ->setDescription($title);

        Breadcrumbs::register('mediapress.year', function ($breadcrumbs) use ($year, $title) {
            $breadcrumbs->parent('mediapress.index');
            $breadcrumbs->push($year, localize_trans_url(locale(), "mediapress::routes.media.year", ['year'=>$year]));
            $breadcrumbs->push($title);
        });

        return view('mediapress::types', compact('medias', 'title'));
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

    public function categoryYear(Category $category, Request $request)
    {
        $year = (int)$request->segment(5);
        $medias = $this->media->findByCategoryYear($category->slug, $year, $this->per_page);

        $title = $category->name . ' ' . $year;

        $this->setTitle($title)
            ->setDescription($title);

        Breadcrumbs::register('mediapress.category.year', function ($breadcrumbs) use ($category, $year) {
            $breadcrumbs->parent('mediapress.index');
            $breadcrumbs->push($category->name, $category->url);
            $breadcrumbs->push($year);
        });

        return view('mediapress::category-year', compact('medias', 'category', 'year', 'title'));
    }


    public function categoryYearType(Category $category, Request $request)
    {
        $year = (int)$request->segment(5);
        $type = $request->segment(6);

        $medias = $this->media->findByCategoryYearByType($category->slug, $year, $type, $this->per_page);

        $title = $category->name . ' ' . $year . ' '. $this->type->get($type);

        Breadcrumbs::register('mediapress.year', function ($breadcrumbs) use ($category, $year, $type, $title) {
            $breadcrumbs->parent('mediapress.index');
            $breadcrumbs->push($category->name, $category->url);
            $breadcrumbs->push($year, localize_trans_url(locale(), "mediapress::routes.media.year", ['year'=>$year]));
            $breadcrumbs->push($this->type->get($type));
        });

        return view('mediapress::types', compact('medias', 'title'));
    }

    public function brand(Brand $brand)
    {
        if(!$brand) return abort(404);

        $medias = $this->media->findByBrand($brand->id, $this->per_page);

        $this->setTitle($brand->title)
            ->setDescription($brand->title);

        Breadcrumbs::register('mediapress.brand', function ($breadcrumbs) use ($brand) {
            $breadcrumbs->parent('mediapress.index');
            $breadcrumbs->push($brand->title, $brand->url);
        });

        return view('mediapress::brand', compact('brand', 'medias'));
    }
}

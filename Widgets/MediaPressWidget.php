<?php namespace Modules\Mediapress\Widgets;


use Modules\Mediapress\Entities\Category;
use Modules\Mediapress\Repositories\CategoryRepository;
use Modules\Mediapress\Repositories\MediaRepository;

class MediaPressWidget
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
        $this->media = $media;
        $this->category = $category;
    }

    public function latest($limit=6, $view="latest")
    {
        $medias = $this->media->latest($limit);
        if($medias->count() > 0) {
            return view('mediapress::widgets.'.$view, compact('medias'));
        }
        return null;
    }

    public function categories($view='category')
    {
        $categories = $this->category->all();
        if($categories->count()>0) {
            return view('mediapress::widgets.'.$view, compact('categories'));
        }
        return null;
    }

    public function yearsByCategory(Category $category, $view='years') {
        $medias     = $category->medias()->years()->get();
        if($medias->count()>0) {
            return view('mediapress::widgets.'.$view, compact('medias', 'category'));
        }
        return null;
    }

    public function years($view='years') {
        $medias     = $this->media->allWithBuilder()->years()->get();
        if($medias->count()>0) {
            return view('mediapress::widgets.'.$view, compact('medias'));
        }
        return null;
    }
}
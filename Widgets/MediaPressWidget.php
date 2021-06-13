<?php namespace Modules\Mediapress\Widgets;


use Modules\Mediapress\Entities\Category;
use Modules\Mediapress\Entities\Media;
use Modules\Mediapress\Entities\Type;
use Modules\Mediapress\Repositories\BrandRepository;
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
    /**
     * @var BrandRepository
     */
    private $brand;
    /**
     * @var Type
     */
    private $type;

    public function __construct(
        MediaRepository $media,
        CategoryRepository $category,
        BrandRepository $brand,
        Type $type
    )
    {
        $this->media = $media;
        $this->category = $category;
        $this->brand = $brand;
        $this->type = $type;
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

    public function brands($view='brand')
    {
        $brands = $this->brand->all();
        if($brands->count()>0) {
            return view('mediapress::widgets.'.$view, compact('brands'));
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

    public function types($view='types')
    {
        $types     = $this->type->lists();
        return view('mediapress::widgets.'.$view, compact('types'));
    }

    public function links(Media $media, $view = "links")
    {
        if($media->media_type == 'digital') {
            if(isset($media->settings['link'])) {
                $digitals = $media->settings['link'];
                return view('mediapress::widgets.'.$view, compact('digitals'));
            }
        } else {
            if(isset($media->settings['link'])) {
                $images = $media->present()->images(800,null,'resize',80);
                $physicals = $media->settings['link'];
                foreach ($physicals as &$physical)
                {
                    if(isset($physical['image'])) {
                        $image = $images[$physical['image'] - 1];
                        if (isset($image)) {
                            $physical['image'] = $images[$physical['image'] - 1];
                        }
                    }
                }
                return view('mediapress::widgets.'.$view, compact('physicals'));
            }
        }
        return null;
    }
}
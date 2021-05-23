<?php

namespace Modules\Mediapress\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Modules\Mediapress\Events\Handlers\MediaSaving;
use Modules\Mediapress\Events\MediaWasCreated;
use Modules\Mediapress\Events\MediaWasDeleted;
use Modules\Mediapress\Events\MediaWasUpdated;
use Modules\Mediapress\Repositories\MediaRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentMediaRepository extends EloquentBaseRepository implements MediaRepository
{
    public function create($data)
    {
        $model = $this->model->create($data);

        event(new MediaWasCreated($model, $data));

        event(new MediaSaving($model));

        return $model;
    }

    public function update($model, $data)
    {
        $model->update($data);

        event(new MediaWasUpdated($model, $data));

//        event(new MediaSaving($model));

        return $model;
    }

    public function destroy($model)
    {
        event(new MediaWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }

    public function findByYear($year = '', $per_page = 10)
    {
        return $this->model
            ->whereYear($year)
            ->paginate($per_page);
    }


    public function findByCategoryYear($slug, $year, $per_page = 10)
    {
        return $this->model
            ->whereYear($year)
            ->whereHas("category.translations", function (Builder $q) use ($slug) {
                $q->where('mediapress__category_translations.slug', $slug);
            })
            ->paginate($per_page);
    }

    public function latest($limit = 6)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy('created_at')->published()->limit($limit)->get();
        }
        return $this->model->orderBy('created_at')->take($limit)->published()->get();
    }

    public function findByBrand($brand="", $per_page = 10)
    {
        return $this->model
            ->where("brand_id", $brand)
            ->orderBy('created_at', 'DESC')
            ->paginate($per_page);
    }

    public function findByYearType($year = "", $type = "", $per_page = 10)
    {
        return $this->model
            ->whereYear($year)
            ->whereType($type)
            ->paginate($per_page);
    }

    public function findByCategoryYearByType($slug, $year, $type, $per_page = 10)
    {
        return $this->model
            ->whereYear($year)
            ->whereType($type)
            ->whereHas("category.translations", function (Builder $q) use ($slug) {
                $q->where('mediapress__category_translations.slug', $slug);
            })
            ->paginate($per_page);
    }
}

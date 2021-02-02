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

        event(new MediaSaving($model));

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
}

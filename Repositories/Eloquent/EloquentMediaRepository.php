<?php

namespace Modules\Mediapress\Repositories\Eloquent;

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

    /**
     * @param string $type
     * @return mixed
     */
    public function findByType($type = '', $per_page = 10)
    {
        if(in_array($type, array_keys(app('mediaTypes')))) {
            return $this->model->where('media_type', $type)->with('translations')->orderBy('release_at', 'desc')->paginate($per_page);
        }
        return $this->model->where('media_type', $type)->orderBy('release_at', 'desc')->paginate($per_page);
    }
}

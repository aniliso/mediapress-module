<?php

namespace Modules\Mediapress\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface MediaRepository extends BaseRepository
{
    /**
     * @param string $type
     * @return mixed
     */
    public function findByType($type='', $per_page=10);
}

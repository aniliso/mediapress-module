<?php

namespace Modules\Mediapress\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface MediaRepository extends BaseRepository
{
    /**
     * @param string $year
     * @param int $per_page
     * @return mixed
     */
    public function findByYear($year='', $per_page=10);

    public function findByCategoryYear($slug, $year, $per_page=10);

    public function latest($limit=6);
}

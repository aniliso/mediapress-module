<?php

namespace Modules\Mediapress\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface MediaRepository extends BaseRepository
{
    public function findByYearType($year="", $type="", $per_page=10);
    /**
     * @param string $year
     * @param int $per_page
     * @return mixed
     */
    public function findByYear($year='', $per_page=10);

    /**
     * @param string $brand
     * @param int $per_page
     * @return mixed
     */
    public function findByBrand($brand='', $per_page=10);

    /**
     * @param $slug
     * @param $year
     * @param int $per_page
     * @return mixed
     */
    public function findByCategoryYear($slug, $year, $per_page=10);

    /**
     * @param $slug
     * @param $year
     * @param $type
     * @param int $per_page
     * @return mixed
     */
    public function findByCategoryYearByType($slug, $year, $type, $per_page=10);

    /**
     * @param int $limit
     * @return mixed
     */
    public function latest($limit=6);
}

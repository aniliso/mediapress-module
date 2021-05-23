<?php namespace Modules\Mediapress\Entities;

class Type
{
    const PHYSICAL = "physical";
    const DIGITAL = "digital";

    /**
     * @var array
     */
    private $types = [];

    /**
     * Type constructor.
     */
    public function __construct()
    {
        $this->types = [
            self::PHYSICAL => trans('mediapress::media.form.media_types.physical'),
            self::DIGITAL => trans('mediapress::media.form.media_types.digital')
        ];
    }

    /**
     * @return array
     */
    public function lists()
    {
        return $this->types;
    }

    /**
     * @param $typeName
     * @return mixed
     */
    public function get($typeName)
    {
        if (isset($this->types[$typeName])) {
            return $this->types[$typeName];
        }

        return $this->types[self::PHYSICAL];
    }
}

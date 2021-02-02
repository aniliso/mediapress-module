<?php

namespace Modules\Mediapress\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'mediapress::category.form';

    public function translationRules()
    {
        $id = $this->route()->parameter('mediapressCategory')->id;

        return [
            'name'     => 'required|max:200',
            'slug'     => "required|unique:mediapress__category_translations,slug,$id,category_id,locale,$this->localeKey"
        ];
    }

    public function rules()
    {
        return [
            'ordering' => 'required|integer'
        ];
    }

    public function attributes()
    {
        return trans('news::category.form');
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }
}

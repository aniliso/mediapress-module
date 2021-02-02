<?php

namespace Modules\Mediapress\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class StoreCategoryRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'mediapress::category.form';

    public function translationRules()
    {
        return [
            'name' => 'required|max:200',
            'slug' => "required|unique:mediapress__category_translations,slug,null,category_id,locale,$this->localeKey",
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
        return trans('mediapress::category.form');
    }

    public function authorize()
    {
        return true;
    }

    public function translationMessages()
    {
        return trans('validation');
    }

    public function messages()
    {
        return [];
    }
}

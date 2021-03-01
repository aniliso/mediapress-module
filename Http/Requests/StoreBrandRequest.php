<?php

namespace Modules\Mediapress\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class StoreBrandRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'mediapress::brand.form';

    public function translationRules()
    {
        return [
        ];
    }

    public function rules()
    {
        return [
            'title'     => 'required|max:200',
            'slug'     => "required|unique:mediapress__brands,slug",
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

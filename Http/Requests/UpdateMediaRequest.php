<?php

namespace Modules\Mediapress\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateMediaRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'mediapress::media.form';

    public function rules()
    {
        return [
            'media_desc' => 'check_domain',
            'release_at' => 'required|date_format:d.m.Y',
            //'sorting'    => 'required|integer',
            'brand'      => 'required'
        ];
    }

    public function attributes()
    {
        return trans('mediapress::media.form');
    }

    public function translationRules()
    {
        return [
            'title' => 'required',
            'slug'  => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'check_domain' => trans('validation.url')
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}

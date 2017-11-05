<div class="box-body">
    {!! Form::i18nInput('title', trans('mediapress::media.form.title'), $errors, $lang, $media, ['data-slug'=>'source']) !!}

    {!! Form::i18nInput('slug', trans('mediapress::media.form.slug'), $errors, $lang, $media, ['data-slug'=>'target']) !!}

    @editor('description', trans('mediapress::media.form.description'), old("{$lang}.description", $media->translate($lang)->description), $lang)
</div>

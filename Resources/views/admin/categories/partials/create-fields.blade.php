<div class="box-body">
    <div class="box-body">
        <div class='form-group{{ $errors->has("{$lang}.name") ? ' has-error' : '' }}'>
            {!! Form::label("{$lang}[name]", trans('mediapress::category.form.name')) !!}
            {!! Form::text("{$lang}[name]", old("{$lang}[name]"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('mediapress::category.form.name')]) !!}
            {!! $errors->first("{$lang}.name", '<span class="help-block">:message</span>') !!}
        </div>
        <div class='form-group{{ $errors->has("{$lang}.slug") ? ' has-error' : '' }}'>
            {!! Form::label("{$lang}[slug]", trans('mediapress::category.form.slug')) !!}
            {!! Form::text("{$lang}[slug]", old("{$lang}[slug]"), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('mediapress::category.form.slug')]) !!}
            {!! $errors->first("{$lang}.slug", '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="box-group" id="accordion">
        <div class="panel box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-{{$lang}}">
                        {{ trans('mediapress::category.title.meta_data') }}
                    </a>
                </h4>
            </div>
            <div style="height: 0px;" id="collapseTwo-{{$lang}}" class="panel-collapse collapse">
                <div class="box-body">
                    {!! Form::i18nInput("meta_title", trans('mediapress::category.form.meta_title'), $errors, $lang) !!}

                    {!! Form::i18nTextarea("meta_description", trans('mediapress::category.form.meta_description'), $errors, $lang, null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

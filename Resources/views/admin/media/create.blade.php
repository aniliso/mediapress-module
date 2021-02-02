@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('mediapress::media.title.create media') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.mediapress.media.index') }}">{{ trans('mediapress::media.title.media') }}</a></li>
        <li class="active">{{ trans('mediapress::media.title.create media') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.mediapress.media.store'], 'method' => 'post', 'id'=>'app']) !!}
    <div class="row">
        <div class="col-md-9">

            <div class="box">
                <div class="box-body" style="padding: 20px;">

                    <div class="nav-tabs-custom">
                        <div class="languages">
                            @include('partials.form-tab-headers')
                            <div class="tab-content">
                                <?php $i = 0; ?>
                                @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                                    <?php $i++; ?>
                                    <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                        @include('mediapress::admin.media.partials.create-fields', ['lang' => $locale])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                            <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                            <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.mediapress.media.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="box">
                <div class="box-body">
                    {!! Form::normalSelect('category_id', trans('mediapress::category.title.category'), $errors, $categoryLists) !!}

                    <div class="form-group{{ $errors->has("start_at") ? ' has-error' : '' }}">
                        {!! Form::label("release_at", trans('mediapress::media.form.release_at').':') !!}
                        <div class='input-group date' id='release_at'>
                            <input type="text" class="form-control" name="release_at" value="{{ old('release_at', Carbon::now()->hour(0)->minute(0)->format('d.m.Y H:i')) }}"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        {!! $errors->first("release_at", '<span class="help-block">:message</span>') !!}
                    </div>

                    {!! Form::normalInput('brand', trans('mediapress::media.form.brand'), $errors, old('brand'), []) !!}

                    {!! Form::normalInput('media_desc', trans('mediapress::media.form.media_desc'), $errors, old('media_desc')) !!}

                    <div class="form-group">
                        {!! Form::hidden('status', 0) !!}
                        <label>
                            {!! Form::checkbox("status", 1, old('status'), ['class'=>'flat-blue']) !!}
                            {{ trans('mediapress::media.form.status') }}
                        </label>
                    </div>

                    @mediaSingle('pressImage', null, null, trans('mediapress::media.form.image'))
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')

    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.mediapress.media.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#release_at').datetimepicker({
                locale: '<?= App::getLocale() ?>',
                allowInputToggle: true,
                format: 'DD.MM.YYYY'
            });
        });
    </script>
@endpush

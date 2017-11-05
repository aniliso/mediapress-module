@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('mediapress::media.title.edit media') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.mediapress.media.index') }}">{{ trans('mediapress::media.title.media') }}</a></li>
        <li class="active">{{ trans('mediapress::media.title.edit media') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.mediapress.media.update', $media->id], 'method' => 'put', 'id'=>'app']) !!}
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-body" style="padding: 20px;">

                    {!! Form::normalSelect('media_type', trans('mediapress::media.form.media_type'), $errors, $mediaTypes, $media, ['class'=>'form-control select2', 'v-model'=>'media.type', 'v-on:change'=>'{ media.desc = "" }']) !!}

                    {!! Form::hidden('media_desc') !!}
                    {!! Form::normalInput('media_desc', trans('mediapress::media.form.media_desc'), $errors, $media, ['v-model'=>'media.desc', 'v-if'=>"media.type == 'tv' || media.type == 'web'"]) !!}

                    <div class="languages">
                        <div class="nav-tabs-custom">
                            @include('partials.form-tab-headers')
                            <div class="tab-content">
                                <?php $i = 0; ?>
                                @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                                    <?php $i++; ?>
                                    <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                        @include('mediapress::admin.media.partials.edit-fields', ['lang' => $locale])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.mediapress.media.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-body" style="padding: 20px;">
                    <div class="form-group{{ $errors->has("start_at") ? ' has-error' : '' }}">
                        {!! Form::label("release_at", trans('mediapress::media.form.release_at').':') !!}
                        <div class='input-group date' id='release_at'>
                            <input type="text" class="form-control" name="release_at" value="{{ old('release_at', $media->release_at->format('d.m.Y')) }}"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        {!! $errors->first("release_at", '<span class="help-block">:message</span>') !!}
                    </div>

                    {!! Form::normalInput('brand', trans('mediapress::media.form.brand'), $errors, $media, []) !!}

                    {!! Form::normalInput('sorting', trans('mediapress::media.form.sorting'), $errors, $media, []) !!}

                    <div class="form-group">
                        {!! Form::hidden('status', 0) !!}
                        <label>
                            {!! Form::checkbox("status", 1, old('status', $media->status), ['class'=>'flat-blue']) !!}
                            {{ trans('mediapress::media.form.status') }}
                        </label>
                    </div>

                    @mediaSingle('pressImage', $media, null, trans('mediapress::media.form.image'))

                    @if(isset($media->settings) && $media->media_type == 'tv')
                    <div class="image">
                        <img src="{{ $media->settings->video_image ?? null }}" class="img-responsive" style="height: 100px;"/>
                    </div>
                    <br/>
                    <div class="video" style="width: 100%; overflow: hidden;">
                        {!! $media->settings->video_html !!}
                    </div>
                    @endif
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
<script src="{{ Module::asset('mediapress:js/vue.js') }}"></script>
<script src="{{ Module::asset('mediapress:js/axios.min.js') }}"></script>
<script type="text/javascript">
    var app = new Vue({
        el: '#app',
        data: {
            media: {
                type: '{{ old('media_type', $media->media_type) }}',
                desc: '{{ old('media_desc', $media->media_desc) }}'
            }
        }
    });
    $(document).ready(function(){
        $('#release_at').datetimepicker({
            locale: '<?= App::getLocale() ?>',
            allowInputToggle: true,
            format: 'DD.MM.YYYY'
        });
    });
</script>
@endpush

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
@endpush

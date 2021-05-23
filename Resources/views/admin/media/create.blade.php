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
                                <div class="box-body" v-if="media_type == 'digital'">
                                    <fieldset>
                                        <legend>@lang('mediapress::media.title.digital media')</legend>
                                    <template v-for="(emr, key) in link">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label v-if="key == 0">@lang('mediapress::media.form.link.author')</label>
                                                    <input :name="'settings[link]['+key+'][author]'" placeholder="@lang('mediapress::media.form.link.author')" class="form-control" :value="emr.author" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label v-if="key == 0">@lang('mediapress::media.form.link.title')</label>
                                                    <input :name="'settings[link]['+key+'][title]'" placeholder="@lang('mediapress::media.form.link.title')" class="form-control" :value="emr.title" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label v-if="key == 0">@lang('mediapress::media.form.link.website')</label>
                                                    <input :name="'settings[link]['+key+'][website]'" placeholder="@lang('mediapress::media.form.link.website')" class="form-control" :value="emr.website" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label v-if="key == 0">@lang('mediapress::media.form.link.date')</label>
                                                    <date-picker :name="'settings[link]['+key+'][date]'" :config="options" placeholder="@lang('mediapress::media.form.link.title')" :value="emr.date"></date-picker>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label v-if="key == 0">&nbsp;</label>
                                                <div class="form-group">
                                                    <a class="btn-floating"
                                                       v-on:click="addRow(key, 'link')" v-if="link.length < 20">
                                                        <i class="fa fa-plus"></i></a>
                                                    <a class="btn-floating"
                                                       v-on:click="removeRow(key, 'link')" v-if="link.length > 1">
                                                        <i class="fa fa-minus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    </fieldset>
                                </div>
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

                    {!! Form::normalSelect('media_type', trans('mediapress::media.form.media_type'), $errors, $types, old('media_type'), [
                    'v-model="media_type"'
                    ]) !!}

                    <div class="form-group{{ $errors->has("start_at") ? ' has-error' : '' }}">
                        {!! Form::label("release_at", trans('mediapress::media.form.release_at').':') !!}
                        <div class='input-group date' id='release_at'>
                            <input type="text" class="form-control" name="release_at" value="{{ old('release_at', Carbon::now()->hour(0)->minute(0)->format('d.m.Y H:i')) }}"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        {!! $errors->first("release_at", '<span class="help-block">:message</span>') !!}
                    </div>

                    {!! Form::normalSelect('brand', trans('mediapress::media.form.brand_id'), $errors, ["Seçiniz"]+$brandLists) !!}

                    <div v-if="media_type == 'physical'">
                    {!! Form::normalInput('media_desc', trans('mediapress::media.form.media_desc'), $errors, old('media_desc')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::hidden('status', 0) !!}
                        <label>
                            {!! Form::checkbox("status", 1, old('status'), ['class'=>'flat-blue']) !!}
                            {{ trans('mediapress::media.form.status') }}
                        </label>
                    </div>
                    <div v-if="media_type == 'physical'">
                    @mediaMultiple('pressImage', null, null, trans('mediapress::media.form.image'))
                    </div>
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
    <script src="{!! Module::asset('mediapress:js/vue.js') !!}"></script>
    <script src="{!! Module::asset('mediapress:js/vuedatetimepicker.js') !!}"></script>
    <script>
        Vue.component('date-picker', VueBootstrapDatetimePicker);
        var app = new Vue({
            el: '#app',
            data: {
                media_type: '{{ old('media_type', 'physical') }}',
                settings: [],
                link :
                    @if(is_array(old('settings.link')))
                        {!! json_encode(old('settings.link')) !!}
                    @else
                        [{ author: '', title   : '', website : '', date : '' }]
                    @endif
                ,
                options: {
                    format: 'DD.MM.YYYY',
                    useCurrent: true,
                    showClear: true,
                    showClose: true,
                }
            },
            methods: {
                addRow: function (index, id) {
                    if(id == 'link') {
                        this.link.splice(index + 1, 0, {});
                    }
                },
                removeRow: function (index, id) {
                    if(id == 'link') {
                        this.link.splice(index, 1);
                    }
                }
            }
        });
    </script>

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

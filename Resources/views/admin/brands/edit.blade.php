@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('mediapress::brand.title.edit brand') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.mediapress.brand.index') }}">{{ trans('mediapress::brand.title.brands') }}</a></li>
        <li class="active">{{ trans('mediapress::brand.title.edit brand') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.mediapress.brand.update', $brand->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-body">
                    {!! Form::normalInput('title', trans('mediapress::brand.form.title'), $errors, $brand, ['data-slug'=>'source']) !!}

                    {!! Form::normalInput('slug', trans('mediapress::brand.form.slug'), $errors, $brand, ['data-slug'=>'target']) !!}
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.mediapress.brand.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box box-primary">
                <div class="box-body">
                    {!! Form::normalInput('ordering', trans('mediapress::category.form.ordering'), $errors, $brand) !!}
                    <div class="form-group">
                        <label for="status">
                            {!! Form::hidden("status", 0) !!}
                            {!! Form::checkbox("status", old("status", 1), true, ['class'=>'flat-blue']) !!}
                            {{ trans('page::pages.form.status') }}
                        </label>
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).keypressAction({
                actions: [
                    {key: 'b', route: "<?= route('admin.mediapress.category.index') ?>"}
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@stop

@extends('layouts.admin')

@section('container')

    <div class="row">
        {!! FORM::open(array('action' => ['PostController@store'],'method' => 'POST','novalidate','role' =>
        'form')) !!}
        <fieldset>
            <div class="form-group col-sm-6 col-sm-offset-3">
                @if ($errors->has())
                    <div class="form-group">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                {!! $error !!}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group col-sm-12">
                <div class="col-sm-6">
                    {!! FORM::label('title','标题') !!}
                </div>
                <div class="col-sm-12">
                    {!! FORM::text('title', @$title,array('class'=>'form-control','placeholder'=>'标题','autofocus'))
                    !!}
                </div>
            </div>

            <div class="form-group col-sm-12">
                <div class="col-sm-6">
                    {!! FORM::label('summary','概览') !!}
                </div>
                <div class="col-sm-12">
                    {!! FORM::textarea('summary', @$summary,array('class'=>'form-control','placeholder'=>'概览'))
                    !!}
                </div>
            </div>

            <div class="form-group col-sm-12">
                <div class="col-sm-6">
                    {!! FORM::label('content','内容') !!}
                </div>
                <div class="col-sm-12">
                    {!! FORM::textarea('content', @$content,array('class'=>'form-control','placeholder'=>'内容'))
                    !!}
                </div>
            </div>

            <div class="form-group col-sm-12">
                <div class="col-sm-6">
                    {!! FORM::label('active','是否发布') !!}
                </div>
                <div class="col-sm-12">
                    {!! FORM::checkbox('active', null , @$active,  array('class'=>'form-control'))
                    !!}
                </div>
            </div>

            <div class="form-group col-sm-12">
                <div class="col-sm-6">
                    {!! FORM::label('link','发布地址') !!}
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-4 text-right">
                        {!! url('/').'/' !!}
                    </div>
                    <div class="col-sm-8">
                        {!! FORM::text('link', @$link,array('class'=>'form-control','placeholder'=>'发布地址'))
                        !!}
                    </div>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <div class="col-sm-6">
                    {!! FORM::label('tags','标签') !!}
                </div>
                <div class="col-sm-12">
                    {!! FORM::text('tags', @$tags,array('class'=>'form-control','placeholder'=>'标签'))
                    !!}
                </div>
            </div>


            <div class="form-group col-sm-12">
                <div class="col-sm-3 text-right">
                </div>
                <div class="col-sm-6">
                    {!! FORM::submit('确认新增', array('class'=>'btn btn-lg btn-success')) !!}
                </div>
            </div>
        </fieldset>
        {!! FORM::close() !!}
    </div>

@stop
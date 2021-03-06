@extends('layouts.admin')

@section('container')

    <div class="row">
        {!! FORM::model($user,array('action' => ['UserController@update',$user->id],'method' => 'PATCH','novalidate','role' =>
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

            <div class="form-group col-sm-12">
                <div class="col-sm-3 text-right">
                    {!! FORM::label('email','邮箱') !!}
                </div>
                <div class="col-sm-6">
                    {!! FORM::email('email', @$email,array('class'=>'form-control','placeholder'=>'E-mail','autofocus'))
                    !!}
                </div>
            </div>

            <div class="form-group col-sm-12">
                <div class="col-sm-3 text-right">
                    {!! FORM::label('username','用户名') !!}
                </div>
                <div class="col-sm-6">
                    {!! FORM::text('username', @$username,array('class'=>'form-control','placeholder'=>'用户名'))
                    !!}
                </div>
            </div>

            <div class="form-group col-sm-12">
                <div class="col-sm-3 text-right">
                    {!! FORM::label('role_id','角色') !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::select('role_id', $roles, @$role_id,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group col-sm-12">
                <div class="col-sm-3 text-right">
                </div>
                <div class="col-sm-6">
                    {!! FORM::submit('确认修改', array('class'=>'btn btn-lg btn-success')) !!}
                </div>
            </div>
        </fieldset>
        {!! FORM::close() !!}
    </div>

@stop
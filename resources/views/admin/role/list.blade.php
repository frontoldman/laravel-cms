@extends('layouts.admin')

@section('container')


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

    @if (session()->has('ok'))
        <div class="form-group">
                <div class="alert alert-success" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    {!! session('ok') !!}
                </div>
        </div>
    @endif

    {!! FORM::open(array('action' => ['RoleController@postRole'],'method' => 'POST','novalidate','role' =>
    'form')) !!}
    <table class="table">
        <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>
                    {!! $role->slug !!}
                </td>
            </tr>
            <tr>
                <td>
                    {!! FORM::text($role->slug, @$role->title,array('class'=>'form-control','placeholder'=>'角色名'))
                    !!}
                </td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td>
                    {!! FORM::submit('保存修改',['class'=>'btn btn-success']) !!}
                </td>
            </tr>
        </tfoot>
    </table>


    {!! FORM::close() !!}

@stop
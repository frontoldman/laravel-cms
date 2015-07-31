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
    <table class="table">
        <thead>
            <tr>
                <th>邮箱</th>
                <th>用户名</th>
                <th>是否认证</th>
                <th>角色</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->username !!}</td>
                <td>{!! $user->confirmed == 1 ? '已认证':' 未认证' !!}</td>
                <td>{!! $user->role->title !!}</td>
                <td>
                    <a class="btn btn-default" href="{{ action('UserController@edit',$user->id)}}">编辑</a>
                </td>
                <td>
                    <a class="btn btn-default" href="#">删除</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop
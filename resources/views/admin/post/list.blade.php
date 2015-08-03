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
                <th>标题</th>
                <th>更新时间</th>
                <th>链接</th>
                <th>是否发布</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{!! $post->title !!}</td>
                <td>{!! $post->updated_at !!}</td>
                <td>{!! $post->link !!}</td>
                <td>{!! $post->active !!}</td>
                <td>
                    <a class="btn btn-default" href="{{ action('PostController@edit',$post->id)}}">编辑</a>
                </td>
                <td>
                    {!! FORM::open(['method' => 'DELETE', 'action' => ['PostController@destroy', $post->id]]) !!}
                    {!! FORM::submit('删除',['class'=>'btn btn-danger']) !!}
                    {!! FORM::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop
@extends('layouts.front')

@section('container')

    @foreach($posts as $post)

        <h1><a href="#">{!! $post->title !!}</a></h1>
        <p>
            {!! $post->summary !!}
        </p>

    @endforeach

@stop
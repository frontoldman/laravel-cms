@extends('layouts.front')

@section('container')

    @foreach($posts as $post)

        <h1><a href="{{ action('PostController@link',$post->link)  }}">{!! $post->title !!}</a></h1>
        <p>
            {!! $post->summary !!}
        </p>

    @endforeach

@stop
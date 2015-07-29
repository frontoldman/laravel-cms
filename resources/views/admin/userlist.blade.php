@extends('layouts.admin')

@section('container')

    @foreach ($users as $user)
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {!! $user->username !!}
        </div>
    @endforeach

@stop
@extends('layouts.admin')

@section('container')

    <table class="table">
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->username !!}</td>
                <td>{!! $user->confirmed !!}</td>
                <td>{!! $user->role->title !!}</td>
                <td>{!! $user->created_at !!}</td>
                <td>{!! $user->updated_at !!}</td>
                <td>
                    <a class="btn btn-default" href="#">编辑</a>
                </td>
                <td>
                    <a class="btn btn-default" href="#">删除</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop
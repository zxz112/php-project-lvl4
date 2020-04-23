@extends('layouts.app')

@section('content')
<div class="container">
@include('flash::message')
{{Form::open(['url' => route('task_statuses.create'), 'method'=>'GET'])}}
    {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
{{Form::close()}}
    <a href="{{ route('task_statuses.create') }}"></a>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">@lang('status.id')</th>
                    <th scope="col">@lang('status.name')</th>
                    <th scope="col">@lang('status.create')</th>
                    <th scope="col">@lang('status.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taskStatuses as $status)
                    <tr>
                        <td>{{$status->id}}</td>
                        <td>{{$status->name}}</td>
                        <td>{{$status->created_at}}</td>
                        <td>
                        <td><a href="{{route('task_statuses.destroy', $status->id)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('status.delete')</td>
                        <td><a href="{{route('task_statuses.edit', $status->id)}}">@lang('status.edit')</td>
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <div>
</div>    
@endsection
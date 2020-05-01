@extends('layouts.app')

@section('content')
<div class="container">
@include('flash::message')
@if (\Auth::check())
{{Form::open(['url' => route('task_statuses.create'), 'method'=>'GET'])}}
    {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
{{Form::close()}}
@endif
    <a href="{{ route('task_statuses.create') }}"></a>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">@lang('status.id')</th>
                    <th scope="col">@lang('status.name')</th>
                    <th scope="col">@lang('status.create')</th>
                    @if (\Auth::check())
                    <th scope="col">@lang('status.actions')</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($taskStatuses as $status)
                    <tr>
                        <td>{{$status->id}}</td>
                        <td>{{$status->name}}</td>
                        <td>{{$status->created_at}}</td>
                        @if (\Auth::check())
                        <td><a href="{{route('task_statuses.destroy', $status)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('action.delete')
                        <a href="{{route('task_statuses.edit', $status)}}">@lang('action.edit')</td>
                        </td>   
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$taskStatuses->links()}}
    <div>
</div>    
@endsection
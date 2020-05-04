@extends('layouts.app')

@section('content')
<div class="container">
@include('flash::message')
@if (\Auth::check())
{{Form::open(['url' => route('tasks.create'), 'method'=>'GET'])}}
    {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
{{Form::close()}}
@endif

{{Form::open(['url' => route('tasks.index'), 'method'=>'GET'])}}
<div class="form-row">
    <div class="col-2">
    {{Form::open(['url' => route('tasks.index'), 'method'=>'GET'])}}
        {{ Form::label('task_status_id', 'Status') }}
        {{ Form::select('filter[status.id]', $statuses, $_GET['filter']['status.id'] ?? '', ['class' => 'form-control'])}}
    </div>
    <div class="col-2">
        {{ Form::label('creator', 'Creator') }}
        {{ Form::select('filter[creator.id]', $users, $_GET['filter']['creator.id'] ?? '', ['class' => 'form-control'])}}
    </div>
    <div class="col-2">
        {{ Form::label('assigned', 'Assigned') }}
        {{ Form::select('filter[assigner.id]', $users, $_GET['filter']['assigner.id'] ?? '', ['class' => 'form-control'])}}
    </div>
    <div class="col-2">
        {{ Form::label('label', 'Label') }}
        {{ Form::select('filter[labels.id]', $labels, $_GET['filter']['labels.id'] ?? '', ['class' => 'form-control'])}}
    </div>
    <div class="col-auto">
    {{Form::submit('Search!', ['class' => 'btn btn-outline-primary', 'style' => 'position: absolute; bottom: 0px'])}}
    {{Form::close()}}
    </div>
</div>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">@lang('task.id')</th>
                    <th scope="col">@lang('task.status')</th>
                    <th scope="col">@lang('task.name')</th>
                    <th scope="col">@lang('task.creator')</th>
                    <th scope="col">@lang('task.asignee')</th>
                    <th scope="col">@lang('task.create')</th>
                    @if (\Auth::check())
                    <th scope="col">@lang('action.actions')</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->status->name}}
                        @foreach ($task->labels as $label)
                        <span class="btn btn-warning btn-bg">
                        {{$label->name}}
                        </span>
                        @endforeach
                        </td>
                        <td><a href="{{route('tasks.show', $task)}}">{{$task->name}}</a></td>
                        <td>{{$task->creator->name}}</td>
                        <td>{{$task->assigner->name ?? ''}}</td>
                        <td>{{$task->created_at}}</td>
                        @if (\Auth::check())
                        <td>
                        @if (\Auth::user()->id === $task->creator->id)
                        <a href="{{route('tasks.destroy', $task)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('action.delete')
                        @endif
                        <a href="{{route('tasks.edit', $task)}}">@lang('action.edit')</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$tasks->links()}}
    <div>
</div>    
@endsection
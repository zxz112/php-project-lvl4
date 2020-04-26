@extends('layouts.app')

@section('content')
<div class="container">
@include('flash::message')
@if (\Auth::check())
{{Form::open(['url' => route('tasks.create'), 'method'=>'GET'])}}
    {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
{{Form::close()}}
@endif
    <a href="{{ route('tasks.create') }}"></a>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">@lang('status.id')</th>
                    <th scope="col">Status</th>
                    <th scope="col">@lang('status.name')</th>
                    <th scope="col">creator</th>
                    <th scope="col">asignee</th>
                    <th scope="col">@lang('status.create')</th>
                    @if (\Auth::check())
                    <th scope="col">@lang('status.actions')</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->status->name}}</td>
                        <td>{{$task->name}}</td>
                        <td>{{$task->creator->name}}</td>
                        <td>{{$task->assigner->name ?? ''}}</td>
                        <td>{{$task->created_at}}</td>
                        @if (\Auth::check())
                        <td>
                        @if (\Auth::user()->id === $task->creator->id)
                        <a href="{{route('tasks.destroy', $task->id)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('status.delete')
                        @endif
                        <a href="{{route('tasks.edit', $task->id)}}">@lang('status.edit')</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    <div>
</div>    
@endsection
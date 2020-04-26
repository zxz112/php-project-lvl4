@extends('layouts.app')

@section('content')
<div class="container">
    <div><h1>Task: {{$task->name}}</h1>
    <form action="{{route('tasks.edit', $task)}}">
        <button class="btn btn-warning btn-bg" value="Edit">Edit</button></div>
    </form>
    <div class="">{{$task->description}}</div>
</div>
@endsection
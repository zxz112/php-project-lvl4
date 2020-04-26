@extends('layouts.app')

@section('content')
<div class="container">
@include('flash::message')
{{Form::model($taskStatus, ['url' => route('task_statuses.update', $taskStatus), 'method' => 'PATCH'])}}
    {{ Form::label('name', 'Имя') }}
    {{ Form::text('name') }}
    {{Form::submit('Edit!', ['class' => 'btn btn-warning btn-bg'])}}
{{Form::close()}}
    <div>
</div>    
@endsection
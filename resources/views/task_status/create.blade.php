@extends('layouts.app')

@section('content')
<div class="container">
{{Form::model($taskStatus, ['url' => route('task_statuses.store')])}}
    {{ Form::label('name', 'Имя') }}
    {{ Form::text('name') }}
    {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
{{Form::close()}}
    <div>
</div>    
@endsection
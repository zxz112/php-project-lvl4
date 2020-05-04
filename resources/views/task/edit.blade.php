@extends('layouts.app')

@section('content')
<div class="container">
@include('flash::message')
@if ($errors->any())
    <div class="alert alert-danger ">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{Form::model($task, ['url' => route('tasks.update', $task), 'method' => 'PATCH'])}}
<div class="form-group col-md-4"> 
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', $task->name, ['class' => 'form-control']) }}
</div>
<div class="form-group col-md-4"> 
    {{ Form::label('description', 'Description') }}
    {{ Form::text('description', $task->description, ['class' => 'form-control']) }}
</div>
<div class="form-group col-md-4"> 
    {{ Form::label('Status', 'Status') }}
    {{ Form::select('task_status_id', $statuses, $task->status->id, ['class' => 'form-control']) }}
</div>
<div class="form-group col-md-4"> 
    {{ Form::label('Assigned', 'Assigned') }}
    {{ Form::select('assigned_to_id', $users, $task->assigned_to_id ?? '', ['class' => 'form-control'])}}
</div>

<div class="form-group col-md-4"> 
    {{ Form::label('labels', 'Label') }}
    {{ Form::select('labels[]', $labels, $task->labels->pluck('id'), ['class' => 'form-control', 'multiple'=>true])}}
</div>

    {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
    
{{Form::close()}}
</div>
</div>
@endsection
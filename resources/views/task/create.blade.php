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

{{Form::model($task, ['url' => route('tasks.store')])}}
<div class="form-group col-md-4"> 
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', '', ['class' => 'form-control']) }}
</div>
<div class="form-group col-md-4"> 
    {{ Form::label('description', 'Description') }}
    {{ Form::text('description', '', ['class' => 'form-control']) }}
</div>
<div class="form-group col-md-4"> 
    {{ Form::label('task_status_id', 'Status') }}
    {{ Form::select('task_status_id', $statuses, '', ['class' => 'form-control']) }}
</div>
<div class="form-group col-md-4"> 
    {{ Form::label('assigned_to_id', 'Assigned') }}
    {{ Form::select('assigned_to_id', $users, 'empty', ['class' => 'form-control'])}}
</div>
    {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
    
{{Form::close()}}
</div>
</div>
@endsection
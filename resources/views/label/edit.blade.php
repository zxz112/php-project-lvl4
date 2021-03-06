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
{{Form::model($label, ['url' => route('labels.update', $label), 'method' => 'PATCH'])}}
    {{ Form::label('name', 'Имя') }}
    {{ Form::text('name') }}
    {{Form::submit('Edit!', ['class' => 'btn btn-warning btn-bg'])}}
{{Form::close()}}
    <div>
</div>    
@endsection
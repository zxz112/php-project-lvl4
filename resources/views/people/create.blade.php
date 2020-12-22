@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        {{ Form::model($people, ['url' => route('people.store')]) }}
        <div class="form-group col-md-4">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', '', ['class' => 'form-control']) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('group_people_id', 'Label') }}
            {{ Form::select('group_people_id', $groups, '', ['class' => 'form-control', 'multiple'=>false])}}
        </div>
        {{ Form::submit('Создать') }}
        {{ Form::close() }}
    </div>
@endsection

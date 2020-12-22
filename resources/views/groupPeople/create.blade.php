@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        {{ Form::model($group, ['url' => route('groups.store')]) }}
        {{ Form::label('name', 'Группа') }}
        {{ Form::text('name') }}<br>
        {{ Form::submit('Создать') }}
        {{ Form::close() }}
    </div>
    </div>
@endsection

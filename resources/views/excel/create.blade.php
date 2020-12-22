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

        {{Form::model($excel, ['url' => route('excel.store')])}}
        <div class="form-group col-md-4">
            {{ Form::label('people', 'People') }}
            {{ Form::select('people[]', $people, '', ['class' => 'form-control', 'multiple'=>true])}}
        </div>
        {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}

        {{Form::close()}}
    </div>
    </div>
@endsection

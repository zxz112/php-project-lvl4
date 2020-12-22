@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        @foreach($excel as $ex)
            <div>
                <tr>
                    <td>{{$ex->id}}</td>
                </tr>
                @foreach($ex->people() as $people)
                    <tr>
                        <td>{{$people}}</td>
                    </tr>
                @endforeach
            </div>
        @endforeach
    </div>
    </div>
@endsection

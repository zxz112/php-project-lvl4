@extends('layouts.app')

@section('content')
    <div class="container">

        @include('flash::message')
        @foreach($groups as $group)
            <div>
                <tr>
                    <td><b>{{$group}}</b></td>
                    @foreach($people as $person)
                        @if($person->group->name == $group)
                            <div>
                <tr>
                    <td>{{$person->name}}</td>
                </tr>
            </div>
            @endif
        @endforeach
        <br>
        </tr>
    </div>
    @endforeach
    </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        @include('flash::message')
        {{Form::open(['url' => route('people.create'), 'method'=>'GET'])}}
        {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
        {{Form::close()}}

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
                @if (\Auth::check())
                    <td><a href="{{route('people.destroy', $person)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('action.delete')</a>
                        <a href="{{route('people.edit', $person)}}">@lang('action.edit')</a></td>
                    </td>
                @endif
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

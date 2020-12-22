@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        {{Form::open(['url' => route('groups.create'), 'method'=>'GET'])}}
        {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
        {{Form::close()}}
        @foreach($group as $gr)
            <div>
                <tr>
                    <td>{{$gr->name}}</td>
                </tr>
                @if (\Auth::check())
                    <td><a href="{{route('groups.destroy', $gr)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('action.delete')</a>
                            <a href="{{route('task_statuses.edit', $gr)}}">@lang('action.edit')</a></td>
                    </td>
                @endif
            </div>
        @endforeach
    </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
@include('flash::message')
@auth

{{Form::open(['url' => route('labels.create'), 'method'=>'GET'])}}
    {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
{{Form::close()}}

@endauth
    <a href="{{ route('labels.create') }}"></a>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">@lang('label.id')</th>
                    <th scope="col">@lang('label.name')</th>
                    <th scope="col">@lang('label.create')</th>
                    @if (\Auth::check())
                    <th scope="col">@lang('action.actions')</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($labels as $label)
                    <tr>
                        <td>{{$label->id}}</td>
                        <td>{{$label->name}}</td>
                        <td>{{$label->created_at}}</td>
                        @if (\Auth::check())
                        <td><a href="{{route('labels.destroy', $label)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('action.delete')
                        <a href="{{route('labels.edit', $label)}}">@lang('action.edit')</td>
                        </td>   
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$labels->links()}}
    <div>
</div>    
@endsection
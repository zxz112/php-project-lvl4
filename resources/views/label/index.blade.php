@extends('layouts.app')

@section('content')
<div class="container">
@include('flash::message')
@if (\Auth::check())
{{Form::open(['url' => route('labels.create'), 'method'=>'GET'])}}
    {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
{{Form::close()}}
@endif
    <a href="{{ route('labels.create') }}"></a>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">@lang('status.id')</th>
                    <th scope="col">@lang('status.name')</th>
                    <th scope="col">@lang('status.create')</th>
                    @if (\Auth::check())
                    <th scope="col">@lang('status.actions')</th>
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
                        <td><a href="{{route('labels.destroy', $label)}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('status.delete')
                        <a href="{{route('labels.edit', $label)}}">@lang('status.edit')</td>
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
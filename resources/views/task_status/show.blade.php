@extends('layouts.app')

@section('content')
<div class="container">
@include('flash::message')

    <h1>{{$taskStatus->name}}</h1>
    <a class="btn btn-link" href="">
        {{ __('Forgot Your Password?') }}
    </a>
    <a class="btn btn-link" href="{{}}">
        {{ Delete}}
    </a>
</div>
@endsection
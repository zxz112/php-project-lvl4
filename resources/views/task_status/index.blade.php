@extends('layouts.app')

@section('content')
<div class="container">
{{Form::open(['url' => route('task_statuses.create'), 'method'=>'GET'])}}
    {{Form::submit('Add new!', ['class' => 'btn btn-warning btn-bg'])}}
{{Form::close()}}
    <a href="{{ route('task_statuses.create') }}"></a>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">created at</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taskStatuses as $status)
                    <tr>
                        <td>{{$status->id}}</td>
                        <td>{{$status->name}}</td>
                        <td>{{$status->created_at}}</td>
                        <td>
                        {{Form::open(array('url' => route('task_statuses.destroy', $status->id), 'method' => 'delete'))}}
                        {{Form::submit('Delete!', ['class' => 'btn btn-warning btn-bg'])}}
                        {{Form::close()}}
                        <a href="{{route('task_statuses.edit', $status->id)}}">Edit
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <div>
</div>    
@endsection
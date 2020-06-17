@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Task {{ $task->name }}</div>
                    <div class="card-body">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @method("PUT")
                            @csrf

                            @include("tasks._form", ["task" => $task])

                            <input type="submit" class="btn btn-primary" value="Update" />
                            <a class="btn btn-secondary" href="{{ route('tasks.show', $task->id) }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


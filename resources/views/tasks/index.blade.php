@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My Tasks</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($tasks))
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Target Completion Date</th>
                                <th scope="col">Completion Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <th scope="col"><a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></th>
                                    <th scope="col">{{ $task->target_completion_date }}</th>
                                    <th scope="col">
                                        @if (!$task->isComplete())
                                            <a href="{{ route('tasks.complete', $task->id) }}" class="btn btn-primary">Complete</a>
                                        @else
                                            {{ $task->completion_date }}
                                        @endif
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        Create some Tasks?
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

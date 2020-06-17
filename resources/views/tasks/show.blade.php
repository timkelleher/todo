@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Task {{ $task->name }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h4>Description</h4>
                                {{ $task->description ?? 'No description.' }}
                                <br />
                            </div>
                            <div class="col-md-3">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Target Completion Date</strong></li>
                                    <li class="list-group-item">{{ $task->target_completion_date ?? 'None' }}</li>
                                    <li class="list-group-item"><strong>Completion Date</strong></li>
                                    <li class="list-group-item">{{ $task->complation_date ?? 'Incomplete' }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                                    <a class="btn btn-primary" href="{{ route('tasks.edit', $task->id) }}">Update</a>
                                    @if ($task->isComplete())
                                        <a class="btn btn-secondary" href="{{ route('tasks.revert', $task->id) }}">Revert Status</a>
                                    @else
                                        <a class="btn btn-secondary" href="{{ route('tasks.complete', $task->id) }}">Complete</a>
                                    @endif

                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


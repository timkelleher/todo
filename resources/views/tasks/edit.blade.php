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

                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" />
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $task->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="name">Target Completion Date</label>
                                <input type="text" class="form-control" id="target_completion_date" name="target_completion_date" value="{{ $task->target_completion_date }}" />
                            </div>

                            <input type="submit" class="btn btn-primary" value="Update" />
                            <a class="btn btn-secondary" href="{{ route('tasks.show', $task->id) }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


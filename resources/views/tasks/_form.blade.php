
@error('name')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Task Name" value="{{ $task->name ?? '' }}" />
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{ $task->description ?? '' }}</textarea>
</div>

<div class="form-group">
    <label for="name">Target Completion Date</label>
    <input type="text" class="form-control" id="target_completion_date" name="target_completion_date" value="{{ $task->target_completion_date ?? '' }}" />
</div>

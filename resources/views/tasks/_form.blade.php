
@error('name')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Task Name" value="{{ $task->name ?? '' }}" />
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="6">{{ $task->description ?? '' }}</textarea>
    <small id="descriptionHelp" class="form-text text-muted">You may use the <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank">Markdown syntax</a> to display formatted text.</small>
</div>

@error('target_completed_date')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="form-group">
    <label for="name">Target Completion Date</label>
    <input type="text" class="form-control datepicker" id="target_completion_date" name="target_completion_date" value="{{ $task->target_completion_date ?? '' }}" />
</div>

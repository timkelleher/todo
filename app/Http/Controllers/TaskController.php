<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', '=', Auth::user()->id)
            ->orderBy('completion_date', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedInputs = $request->validate($this->getValidationRules());
        $inputs = array_merge($validatedInputs, ['user_id' => Auth::user()->id]);
        Task::create($inputs);

        $request->session()->flash('status', 'Task successfully created');

        return redirect()
            ->action('TaskController@index');
    }

    /**
     * Show the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $this->validateUserOwnsTask($task);

        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->validateUserOwnsTask($task);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $this->validateUserOwnsTask($task);

        $validatedInputs = $request->validate($this->getValidationRules());
        $task->update($validatedInputs);
        $task->save();

        $request->session()->flash('status', 'Task successfully updated');

        return redirect()
            ->action('TaskController@index');
    }

    /**
     * Mark task as completed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $this->validateUserOwnsTask($task);

        if ($task->isComplete()) {
            $request->session()->flash('status', 'Task already complete');

            return redirect()
                ->action('TaskController@index');
        }

        $task->completion_date = new \DateTime();
        $task->save();

        $request->session()->flash('status', 'Task successfully completed');

        return redirect()
            ->action('TaskController@index');
    }

    /**
     * Undo task completion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revert(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $this->validateUserOwnsTask($task);

        if (!$task->isComplete()) {
            $request->session()->flash('status', 'Task is not complete');

            return redirect()
                ->action('TaskController@index');
        }

        $task->completion_date = null;
        $task->save();

        $request->session()->flash('status', 'Task status successfully reverted');

        return redirect()
            ->action('TaskController@index');
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $this->validateUserOwnsTask($task);

        $task->destroy($id);

        $request->session()->flash('status', 'Task status successfully deleted');

        return redirect()
            ->action('TaskController@index');
    }

    private function validateUserOwnsTask(Task $task)
    {
        $userId = Auth::user()->id;
        if ($task->user->id !== $userId) {
            throw new AccessDeniedHttpException('Cannot access a Task that does not belong to you');
        }
    }

    private function getValidationRules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'description' => 'nullable',
            'target_completion_date' => 'nullable|date',
        ];
    }
}

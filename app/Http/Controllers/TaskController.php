<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in-progress,done',
            'due_date' => 'required|date|after_or_equal:today',
        ]);


        Task::create(array_merge(
            ['user_id' => auth()->id()],
            $validated
        ));

        return redirect()->route('tasks.index')->with('success', 'Zadanie zostało dodane.');
    }

    public function show(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in-progress,done',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    public function generatePublicLink(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->public_token = Str::random(32);
        $task->public_token_expires_at = Carbon::now()->addHours(24);
        $task->save();

        return redirect()->route('tasks.show', $task)->with('success', 'Publiczny link został wygenerowany.');
    }

    public function showPublic($token)
    {
        $task = Task::where('public_token', $token)
            ->where('public_token_expires_at', '>', Carbon::now())
            ->first();

        if (!$task) {
            abort(404, 'Link jest nieprawidłowy lub wygasł.');
        }

        return view('tasks.public_show', compact('task'));
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
    }
}

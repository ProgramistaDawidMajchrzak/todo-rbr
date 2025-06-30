<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Notifications\TaskDueTomorrow;
use Carbon\Carbon;

class SendTaskReminders extends Command
{
    protected $signature = 'tasks:send-reminders';
    protected $description = 'Wysyła przypomnienia e-mail dla zadań z terminem jutro';

    public function handle()
    {
        // $tasks = Task::whereDate('due_date', Carbon::today())
        $tasks = Task::whereDate('due_date', Carbon::tomorrow())
            ->with('user')
            ->get();

        foreach ($tasks as $task) {
            if ($task->user && $task->user->email) {
                $task->user->notify(new TaskDueTomorrow($task));
            }
        }

        $this->info("Wysłano dla " . $tasks->count() . " zad");
    }
}

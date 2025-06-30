<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;

class TaskDueTomorrow extends Notification
{
    public function __construct(public Task $task)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Przypomnienie: zadanie na jutro')
            ->line("Zadanie: {$this->task->name}")
            ->line("Termin: {$this->task->due_date->format('Y-m-d')}")
            ->action('Zobacz zadanie', route('tasks.show', $this->task))
            ->line('Zrób to natychmiast, nie na ostatnią chwile jak ja to zadanie rekrutacyjne');
    }
}

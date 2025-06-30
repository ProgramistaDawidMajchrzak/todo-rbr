@extends('layouts.public')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $task->name }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p><strong>Status:</strong> {{ $task->status }}</p>
                        <p><strong>Priorytet:</strong> {{ $task->priority }}</p>
                        <p><strong>Termin:</strong> {{ $task->due_date ?? 'brak' }}</p>
                        <p class="mt-4"><strong>Opis:</strong><br>{{ $task->description }}</p>
                        <p class="mt-4 text-sm text-gray-500">(dostep wazny do {{ $task->public_token_expires_at->format('Y-m-d H:i') }})</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


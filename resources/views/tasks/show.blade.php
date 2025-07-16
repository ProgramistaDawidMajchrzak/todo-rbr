<x-app-layout>
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
                        <div class="mb-4">
                            <p><strong>Status:</strong> {{ $task->status }}</p>
                            <p><strong>Priorytet:</strong> {{ $task->priority }}</p>
                            <p><strong>Termin:</strong> {{ $task->due_date ?? 'brak' }}</p>
                            <p class="mt-4"><strong>Opis:</strong><br>{{ $task->description }}</p>
                        </div>

                        <form action="{{ route('tasks.generatePublicLink', $task) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="bg-blue-700 text-white hover:bg-blue-800 font-bold px-10 py-2 rounded shadow-md transition duration-300">
                                Wygeneruj publiczny link do zadania (ważny 24h)
                            </button>
                        </form>

                        @if(session('success'))
                            <p class="mt-2 text-green-600">{{ session('success') }}</p>
                        @endif

                        @if($task->public_token && $task->public_token_expires_at > now())
                            <p class="mt-2">
                                Publiczny link: 
                                <a href="{{ route('tasks.showPublic', $task->public_token) }}" class="text-blue-600 underline" target="_blank">
                                    {{ route('tasks.showPublic', $task->public_token) }}
                                </a>
                                (ważny do {{ $task->public_token_expires_at->format('Y-m-d H:i') }})
                            </p>
                        @endif

                        <div class="flex gap-4">
                            <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-600 hover:underline">Edytuj</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Na pewno usunąć?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Usuń</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

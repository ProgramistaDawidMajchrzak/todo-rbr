<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Twoje zadania') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        @if (session('success'))
                            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($tasks->count())
                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        <table class="w-full text-left">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="p-3">Nazwa</th>
                                                    <th class="p-3">Status</th>
                                                    <th class="p-3">Priorytet</th>
                                                    <th class="p-3">Termin</th>
                                                    <th class="p-3">Akcje</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tasks as $task)
                                                    <tr class="border-t">
                                                        <td class="p-3">{{ $task->name }}</td>
                                                        <td class="p-3">{{ $task->status }}</td>
                                                        <td class="p-3">{{ $task->priority }}</td>
                                                        <td class="p-3">{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}</td>
                                                        <td class="p-3 flex gap-3 justify-center">
                                                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:underline">Pokaż</a>
                                                            <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-600 hover:underline">Edytuj</a>
                                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Na pewno usunąć?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 hover:underline">Usuń</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <p>Brak zadań. <a href="{{ route('tasks.create') }}" class="text-blue-600 underline">Dodaj nowe</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj zadanie') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                            @csrf

                            @include('tasks.partials.form')

                            <button type="submit" 
                                class="bg-blue-700 hover:bg-blue-800 font-bold px-10 py-8 rounded shadow-md transition duration-300">
                                Zapisz
                            </button>                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

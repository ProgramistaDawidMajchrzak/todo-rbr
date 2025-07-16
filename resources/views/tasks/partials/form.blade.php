<div>
    <label for="name" class="block font-semibold">Nazwa</label>
    <input type="text" name="name" id="name" value="{{ old('name', $task->name ?? '') }}" required
           class="w-full border rounded p-2 mt-1">
    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div>
    <label for="description" class="block font-semibold">Opis (Opcjonalnie)</label>
    <textarea name="description" id="description" rows="3"
              class="w-full border rounded p-2 mt-1">{{ old('description', $task->description ?? '') }}</textarea>
</div>

<div>
    <label for="priority" class="block font-semibold">Priorytet</label>
    <select name="priority" id="priority" class="w-full border rounded p-2 mt-1">
        @foreach (['low' => 'Niski', 'medium' => 'Średni', 'high' => 'Wysoki'] as $val => $label)
            <option value="{{ $val }}" @selected(old('priority', $task->priority ?? '') === $val)>{{ $label }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="status" class="block font-semibold">Status</label>
    <select name="status" id="status" class="w-full border rounded p-2 mt-1">
        @foreach (['to-do' => 'Do zrobienia', 'in-progress' => 'W trakcie', 'done' => 'Zrobione'] as $val => $label)
            <option value="{{ $val }}" @selected(old('status', $task->status ?? '') === $val)>{{ $label }}</option>
        @endforeach
    </select>
</div>
@php
    $dueDate = old('due_date', isset($task) ? optional($task->due_date)->format('Y-m-d') : '');
    $today = date('Y-m-d');
@endphp

<div>
    <label for="due_date" class="block font-semibold">Termin</label>
    <input type="date" name="due_date" id="due_date" value="{{ $dueDate }}"
           min="{{ $today }}" class="w-full border rounded p-2 mt-1" required>
</div>
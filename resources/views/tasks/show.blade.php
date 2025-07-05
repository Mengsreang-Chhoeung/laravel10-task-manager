<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow sm:rounded-lg p-4">
                <h1 class="text-lg font-medium">{{ $task->title }}</h1>
                <p class="mt-2">{{ $task->description }}</p>
                <p class="mt-2">Due: {{ $task->due_date?->format('M d, Y') ?? '—' }}</p>
                <p class="mt-2">Status: {{ ucfirst($task->status) }}</p>
                <div class="mt-4">
                    <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-500">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

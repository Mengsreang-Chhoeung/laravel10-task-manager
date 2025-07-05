<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="bg-white shadow sm:rounded-lg p-4">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-lg font-medium">Your Tasks</h1>
                    <a href="{{ route('tasks.create') }}" class="text-blue-500">+ New Task</a>
                </div>
                @foreach($tasks as $task)
                    <div class="task-card border-b last:border-b-0 py-2">
                        <h2 class="font-semibold">{{ $task->title }}</h2>
                        <p>Due: {{ $task->due_date?->format('M d, Y') ?? '—' }}</p>
                        <p>Status: {{ ucfirst($task->status) }}</p>
                        <div class="mt-2 space-x-2">
                            <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-500">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

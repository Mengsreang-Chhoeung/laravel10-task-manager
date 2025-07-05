@extends('layouts.app')

@section('content')
<x-container>
    <h1>Your Tasks</h1>
    <a href="{{ route('tasks.create') }}">+ New Task</a>
    @foreach($tasks as $task)
    <div class="task-card">
        <h2>{{ $task->title }}</h2>
        <p>Due: {{ $task->due_date?->format('M d, Y') ?? '—' }}</p>
        <p>Status: {{ ucfirst($task->status) }}</p>
        <a href="{{ route('tasks.edit', $task) }}">Edit</a>
        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button>Delete</button>
        </form>
    </div>
    @endforeach

    {{ $tasks->links() }}
</x-container>
@endsection
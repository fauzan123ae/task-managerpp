@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Task</h1>

        <!-- Tampilkan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Edit Task -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Judul Task -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul:</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ $task->title }}" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi:</label>
                        <textarea name="description" class="form-control" id="description" rows="3" required>{{ $task->description }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <!-- Jatuh Tempo -->
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Jatuh Tempo:</label>
                        <input type="date" name="due_date" class="form-control" id="due_date" value="{{ $task->due_date }}" required>
                    </div>

                    <!-- User ID -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User ID:</label>
                        <input type="text" name="a" disabled class="form-control" id="user_id" value="{{ $task->user->name }}" required>
                    </div>

                    <!-- Tombol Update -->
                    <button type="submit" class="btn btn-primary btn-block">Update Task</button>
                </form>
            </div>
        </div>
    </div>
@endsection

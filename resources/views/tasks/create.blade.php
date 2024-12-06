@extends('layouts.app')

@section('content')
    <h1>Tambah Task</h1>

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

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Judul:</label>
            <input type="text" name="title" class="form-control" id="title" >
        </div>

        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea name="description" class="form-control" id="description" rows="3" ></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" >
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label for="due_date">Jatuh Tempo:</label>
            <input type="date" name="due_date" class="form-control" id="due_date" >
        </div>

        <!-- Hidden input for User ID -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <!-- Dropdown untuk kategori -->
        <div class="form-group">
            <label for="category_id">Kategori:</label>
            <select name="category_id" id="category_id" class="form-control" >
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Task</button>
    </form>
@endsection
@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Створити нову роль</h1>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Назва ролі</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="mb-3">
                <label for="permissions" class="form-label">Пермішени</label>
                <select multiple class="form-control" name="permissions[]" id="permissions">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Створити роль</button>
        </form>
    </div>
@endsection

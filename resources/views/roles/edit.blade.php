@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Редагувати роль: {{ $role->name }}</h1>

        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Назва ролі</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}" required>
            </div>

            <div class="mb-3">
                <label for="permissions" class="form-label">Пермішени</label>
                <select multiple class="form-control" name="permissions[]" id="permissions">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}"
                                @if ($role->permissions->contains($permission)) selected @endif>
                            {{ $permission->display_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Оновити роль</button>
        </form>
    </div>
@endsection

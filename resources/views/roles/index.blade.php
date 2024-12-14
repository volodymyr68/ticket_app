@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Управління ролями</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Роль</th>
                <th>Пермішени</th>
                <th>Оновити</th>
                <th>Видалити</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @foreach ($role->permissions as $permission)
                            <span class="badge bg-primary">{{ $permission->display_name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Редагувати</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Role management</h1>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Role</th>
                <th>Permissions</th>
                <th>Update</th>
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
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

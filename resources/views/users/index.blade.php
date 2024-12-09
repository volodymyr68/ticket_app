@extends('layouts.main')

<style>
    /* Основные стили контейнера */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Заголовок */
    .container h2 {
        color: #333;
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    /* Кнопки */
    .btn {
        font-size: 0.9rem;
        padding: 8px 12px;
        border-radius: 4px;
        text-transform: uppercase;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        color: #fff;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #fff;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
        border: none;
    }

    .btn-danger:hover {
        background-color: #b02a37;
        color: #fff;
    }

    /* Таблица */
    .table {
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        margin-bottom: 20px;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }

    .table th, .table td {
        padding: 12px 15px;
        text-align: left;
    }

    .table th {
        background-color: #343a40;
        color: #fff;
        font-weight: bold;
    }

    .table td {
        color: #555;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tbody tr:hover {
        background-color: #e9ecef;
        cursor: pointer;
    }

    /* Действия */
    .table td .btn {
        margin-right: 5px;
    }

    .table td .btn:last-child {
        margin-right: 0;
    }
</style>


@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">User List</h2>

        <!-- Фильтры -->
        <form method="GET" action="{{ route('user.index') }}" class="mb-4">
            <div class="row g-3">
                <!-- Поиск -->
                <div class="col-md-4">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by name or email"
                        value="{{ request('search') }}">
                </div>

                <!-- Фильтр по роли -->
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Filter by Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Фильтр по полу -->
                <div class="col-md-3">
                    <select name="sex" class="form-select">
                        <option value="">Filter by Gender</option>
                        <option value="male" {{ request('sex') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ request('sex') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <!-- Кнопки -->
                <div class="col-md-2 d-flex">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <!-- Таблица -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>
                    <a href="{{ route('user.index', array_merge(request()->all(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="text-light">
                        #
                        @if(request('sort') === 'id')
                            <i class="ms-1 {{ request('direction') === 'asc' ? 'fas fa-arrow-up' : 'fas fa-arrow-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('user.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="text-light">
                        Name
                        @if(request('sort') === 'name')
                            <i class="ms-1 {{ request('direction') === 'asc' ? 'fas fa-arrow-up' : 'fas fa-arrow-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('user.index', array_merge(request()->all(), ['sort' => 'email', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="text-light">
                        Email
                        @if(request('sort') === 'email')
                            <i class="ms-1 {{ request('direction') === 'asc' ? 'fas fa-arrow-up' : 'fas fa-arrow-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Role</th>
                <th>Sex</th>
                <th>
                    <a href="{{ route('user.index', array_merge(request()->all(), ['sort' => 'number', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="text-light">
                        Number
                        @if(request('sort') === 'number')
                            <i class="ms-1 {{ request('direction') === 'asc' ? 'fas fa-arrow-up' : 'fas fa-arrow-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($user->sex ?? 'Not specified') }}</td>
                    <td>{{ $user->number ?? 'N/A' }}</td>
                    <td>
                        @if ($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                        @else
                            <span>No image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No users found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Пагинация -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection

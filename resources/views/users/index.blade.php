@extends('layouts.main')

@section('content')
    @vite('resources/css/users/index.css')
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
                    <a href="{{ route('user.index', array_merge(request()->all(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                       class="text-light">
                        #
                        @if(request('sort') === 'id')
                            <i class="ms-1 {{ request('direction') === 'asc' ? 'fas fa-arrow-up' : 'fas fa-arrow-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('user.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                       class="text-light">
                        Name
                        @if(request('sort') === 'name')
                            <i class="ms-1 {{ request('direction') === 'asc' ? 'fas fa-arrow-up' : 'fas fa-arrow-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('user.index', array_merge(request()->all(), ['sort' => 'email', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                       class="text-light">
                        Email
                        @if(request('sort') === 'email')
                            <i class="ms-1 {{ request('direction') === 'asc' ? 'fas fa-arrow-up' : 'fas fa-arrow-down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Role</th>
                <th>Sex</th>
                <th>
                    <a href="{{ route('user.index', array_merge(request()->all(), ['sort' => 'number', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                       class="text-light">
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
                            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image"
                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                        @else
                            <span>No image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete
                            </button>
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

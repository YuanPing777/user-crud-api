@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>User Management</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('users.index') }}" class="row g-2 mb-4">
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : ''}}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : ''}}>Inactive</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
            <a href="{{ route('users.export', request()->query()) }}" class="btn btn-outline-secondary">Export</a>
        </div>
    </form>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $user->id }}"></td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>
                        <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id )}}" class="btn btn-sm btn-warning">Edit</a>

                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this User?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No users found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <form method="POST" action="{{ route('users.bulkDelete')}}" id="bulk-delete-form">
        @csrf
        <input type="hidden" name="ids_json" id="bulk-delete-ids" />
        <div class="mt-3">
            <button type="submit" class="btn btn-danger" onclick="return handleBulkDelete()">Bulk Delete</button>
        </div>
    </form>
    
    <div class="mt-3">
        {{ $users->withQueryString()->links() }}
    </div>
</div>

<script>
    document.getElementById('select-all').addEventListener('click', function (e) {
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(cb => cb.checked = e.target.checked);
    });

    function handleBulkDelete() {
        const selected = Array.from(document.querySelectorAll('input[name="ids[]"]:checked'))
                              .map(cb => cb.value);

        if (selected.length === 0) {
            alert('Please select at least one user to delete.');
            return false;
        }

        if (!confirm('Are you sure to delete selected users?')) {
            return false;
        }

        document.getElementById('bulk-delete-ids').value = JSON.stringify(selected);
        return true;
    }
</script>

@endsection
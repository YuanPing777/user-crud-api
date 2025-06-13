<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '')}}">
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="text" name="email" class="form-control" value="{{ old('email', $user->email ?? '')}}">
</div>

<div class="mb-3">
    <label>Phone Number</label>
    <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number ?? '')}}">
</div>

@if (!isset($user))
    <div class="mb-3">
        <label>Password</label>
        <input type="text" name="password" class="form-control">
    </div>
@endif

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="active" {{ old('status', $user->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status', $user->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<button type="submit" class="btn btn-success">{{ $button }}</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
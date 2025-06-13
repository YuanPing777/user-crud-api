@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Create User</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        @include('users.partials.form', ['button' => 'Create'])
    </form>
</div>
@endsection
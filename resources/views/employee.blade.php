@extends('layouts.main')

@section('content')

    <form action="{{ route('create-employee') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                @switch (auth()->user()->role)
                    @case('super_admin')
                        <option value="admin">Admin</option>
                        <option value="user">Teknisi</option>
                        <option value="super_admin">Super Admin</option>
                        @break
                    @case('admin')
                        <option value="user">Teknisi</option>
                        @break
                @endswitch
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>

@endsection
@extends('layouts.app')

@section('content')
<a href="{{ route('employees.show', $employee->id) }}">View Details</a>

  <div class="container">
       
        <h2>Employees</h2>
        <ul>
            {{-- @foreach ($company->employees as $employee)
                <li>{{ $employee->name }}</li>
            @endforeach --}}
        </ul>
    </div>
<div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <p>{{ $employee->first_name }}</p>
</div>
<div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <p>{{ $employee->last_name }}</p>
</div>
<div class="mb-3">
    <label for="company" class="form-label">Company</label>
    <p>{{ $employee->company->name }}</p>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <p>{{ $employee->email }}</p>
</div>
<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <p>{{ $employee->phone }}</p>
</div>
<a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">Edit</a>
<form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>
@endsection

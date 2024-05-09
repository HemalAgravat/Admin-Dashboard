@extends('layouts.app')

@section('content')
<h1>Employees</h1>
<a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Create Employee</a>

<table class="table">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->company->name }}</td>
                <td>{{ $employee->phone }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
  {{-- Display pagination links --}}
  <div class="pagination">
    {{ $employees->links() }}
</div>
@endsection

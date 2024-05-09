<!-- resources/views/companies/index.blade.php -->
@extends('layouts.app')
@section('content')
    <h1>Companies</h1>

    <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Create New Company</a>

    @if($companies->isEmpty())
        <p>No companies found.</p>
    @else
        <table class="table table-bordered table-striped" style="border: 1px solid #ccc;">
            <thead style="background-color: #007bff; color: white;">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td><a href="{{ route('employees.index', ['company' => $company->id]) }}">{{ $company->name }}</a></td> --}}
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td><img src="{{ asset('/storage/logo/'.$company->logo) }}" alt="{{ $company->name }}" style="max-width: 100px; max-height: 100px;"></td>
                        <td>{{ $company->website }}</td>
                        <td>{{ $company->status }}</td>
                        <td>{{ $company->created_at }}</td>
                        <td>{{ $company->updated_at }}</td>
                        <td>
                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" style="display: block; margin: 2 auto;">Delete</button>
                            </form>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
         {{-- Display pagination links --}}
        <div class="pagination">
            {{ $companies->links() }}
        </div>
    @endif
@endsection

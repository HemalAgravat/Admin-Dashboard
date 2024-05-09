<!-- resources/views/companies/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Company</h1>

    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $company->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $company->email }}" required>
        </div>
        <div class="form-group">
            <label for="logo">Logo (minimum 100x100):</label>
            <input type="file" name="logo" id="logo" class="form-control-file" accept="image/*">
            <img src="{{ asset('/storage/logo/' .$company->logo) }}" alt="Company Logo" style="max-width: 100px; max-height: 100px;">
        </div>
        <div class="form-group">
            <label for="website">Website:</label>
            <input type="url" name="website" id="website" class="form-control" value="{{ $company->website }}">
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="active" {{ $company->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $company->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <!-- Displaying Updated Date, Created Date, and Deleted Date is typically not included in the edit form -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

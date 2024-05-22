@include('bootfile.nav')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Company</title>
    <style>
        .msgpopup {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-30%);
            z-index: 9999;
            width: 50%;
            max-width: 400px;
            animation: slideInOut2 0.7s forwards, disappear 5s forwards;
        }

        @keyframes slideInOut2 {
            0% {
                top: -100%;
            }

            100% {
                top: 10%;
            }
        }

        @keyframes disappear {
            10% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }
    </style>
</head>

<body>
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-13">
                    <div class="iq-card">
                        <div class="col-10">
                            <div class="iq-header-title">
                                <h2 style="color: rgb(251, 134, 88); margin-left:40px">Company List</h2>
                                <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3"
                                    style="margin-left: 40px">Create New Company</a>
                                    <form action="{{ route('companies.index') }}" method="GET" class="mb-3">
                                        <div class="input-group"style="width: 50%;">
                                            <input type="text" name="search" class="form-control" placeholder="Search companies..." value="{{ request('search') }}">
                                        </div>
                                    </form>
                                @if ($companies->isEmpty())
                                    <p>No companies found.</p>
                                @else
                                    <table id="user-list-table" class="table table-striped table-bordered"
                                        role="grid"aria-describedby="user-list-page-info">
                                        <thead>
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
                                            @foreach ($companies as $company)
                                                <tr>
                                                    <td>{{ $com++ }}</td>
                                                    {{-- <td><a href="{{ route('employees.index', ['company' => $company->id]) }}">{{ $company->name }}</a></td> --}}
                                                    <td>{{ $company->name }}</td>
                                                    <td>{{ $company->email }}</td>
                                                    <td><img src="{{ asset('/storage/logo/' . $company->logo) }}"
                                                            alt="{{ $company->name }}"
                                                            style="max-width: 100px; max-height: 100px;"></td>
                                                    <td>{{ $company->website }}</td>
                                                    <td>{{ $company->status }}</td>
                                                    <td>{{ $company->created_at }}</td>
                                                    <td>{{ $company->updated_at }}</td>
                                                    <td>
                                                        @if ($company->status == 'active')
                                                            <a href="{{ route('companies.show', $company->id) }}"
                                                                class="btn btn-sm btn-info">View</a>
                                                            <a href="{{ route('companies.edit', $company->id) }}"
                                                                class="btn btn-sm btn-primary">Edit</a>

                                                            <form
                                                                action="{{ route('companies.destroy', $company->id) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    onclick="return confirm('Are you sure?')"
                                                                    style="display: block; margin: 2 auto;">Delete</button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('companies.trashed', $company->id) }}"
                                                                method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-warning"
                                                                    onclick="return confirm('Are you sure?')"
                                                                    style="display: block; margin: 2 auto;">Retore</button>
                                                            </form>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                                {{-- Display pagination links --}}
                                <div class="pagination">
                                    {{ $companies->links() }}
                                </div>
                                @if (session()->has('success'))
                                    <div class="msgpopup">
                                        <div
                                            class="alert alert-success bg-success text-dark border-0 alert-dismissible fade show text-center">
                                            {{ session('success') }}
                                        </div>
                                    </div>
                                @endif
                                @if (session()->has('edit'))
                                    <div class="msgpopup">
                                        <div
                                            class="alert alert-success bg-primary text-light border-0 alert-dismissible fade show text-center">
                                            {{ session('edit') }}
                                        </div>
                                    </div>
                                @endif
                                @if (session()->has('delete'))
                                    <div class="msgpopup">
                                        <div
                                            class="alert alert-success bg-danger text-light border-0 alert-dismissible fade show text-center">
                                            {{ session('delete') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if (session()->has('Restore'))
                                <div class="msgpopup">
                                    <div
                                        class="alert alert-success bg-warning text-dark border-0 alert-dismissible fade show text-center">
                                        {{ session('Restore') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</body>

</html>

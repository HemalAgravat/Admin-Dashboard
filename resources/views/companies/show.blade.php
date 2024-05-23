@include('bootfile.nav')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees</title>
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
                <div class="col-sm-12">
                    <div class="iq-card">
                        {{-- <div class="iq-card-header d-flex justify-content-between"> --}}
                        <div class="iq-header-title">
                            <h2 style="color: rgb(251, 134, 88); margin-left:40px; margin-bottom:20px">Company Employees
                                List</h2>
                            {{-- <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3"
                                style="margin-left:40px">Create Employee</a> --}}

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Company_name</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($company as $employee)
                                        <tr>
                                            <td>{{ $employee->first_name }}</td>
                                            <td>{{ $employee->last_name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->phone }}</td>
                                            <td>
                                                <a href="{{ route('employees.show', $employee->id) }}"
                                                    class="btn btn-sm btn-info">View</a>
                                                <a href="{{ route('employees.edit', $employee->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('employees.destroy', $employee->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @if (session()->has('edit'))
                                    <div class="msgpopup">
                                        <div
                                            class="alert alert-success bg-primary text-light border-0 alert-dismissible fade show text-center">
                                            {{ session('edit') }}
                                        </div>
                                    </div>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>

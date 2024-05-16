@include('bootfile.nav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees-List</title>
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
            0% {
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
                    <div class="col-13" style="margin-left: 20px; margin-right: 20px;">
                        <div class="iq-header-title">
                            <h2 style="color: rgb(251, 134, 88); margin-left: 40px;">Employees List</h2>
                            <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3"
                                style="margin-left: 40px;">Create Employee</a>
                        </div>
                        <table class="table" id='employee-table'>
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#employee-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employees.index') }}", // Make sure this route exists
            columns: [{
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },{
                    data: 'company',
                    name: 'company'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>
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
</body>
</html>
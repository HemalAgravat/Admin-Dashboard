@include('bootfile.nav')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Employees</title>
</head>

<body>
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card" style="padding: 40px;">
                        <div class="col-10" style="margin-left: 100px;">
                            <div class="iq-header-title">
                                <h2 style="color: rgb(251, 134, 88)">Create Employee</h2>

                                <form action="{{ route('employees.store') }}" method="POST" id="employee-form"
                                    onsubmit="return validateForm()">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name">
                                        <span id="first_name_error" style="color: rgb(65, 1, 156)"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name">
                                        <span id="last_name_error" style="color: rgb(65, 1, 156)"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="company_id" class="form-label">Company</label>
                                        <select class="form-control" id="company_id" name="company_id">
                                            @foreach ($com as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <span id="company_id_error" style="color: rgb(65, 1, 156)"></span>

                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control " id="email" name="email">
                                        <span id="emailerror" style="color: rgb(65, 1, 156)"></span>

                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control"id="phone" name="phone">
                                        <span id="phoneerror" style="color: rgb(65, 1, 156)"></span>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
                                <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
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

                                    function validateForm() {
                                        var firstName = document.getElementById("first_name").value;
                                        var lastName = document.getElementById("last_name").value;
                                        var company = document.getElementById("company_id").value;
                                        var email = document.getElementById("email").value;
                                        var phone = document.getElementById("phone").value;

                                        var firstNameError = document.getElementById("first_name_error");
                                        var lastNameError = document.getElementById("last_name_error");
                                        var companyError = document.getElementById("company_id_error");
                                        var emailError = document.getElementById("emailerror");
                                        var phoneError = document.getElementById("phoneerror");

                                        firstNameError.textContent = "";
                                        lastNameError.textContent = "";
                                        companyError.textContent = "";
                                        emailError.textContent = "";
                                        phoneError.textContent = "";

                                        var isValid = true;

                                        if (firstName.trim() === "") {
                                            firstNameError.textContent = "Please enter First Name";
                                            isValid = false;
                                        }

                                        if (lastName.trim() === "") {
                                            lastNameError.textContent = "Please enter Last Name";
                                            isValid = false;
                                        }

                                        if (company.trim() === "") {
                                            companyError.textContent = "Please select a Company";
                                            isValid = false;
                                        }
                                        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                        if (email.trim() !== "" && !emailRegex.test(email)) {
                                            emailError.textContent = "Please enter a valid email address";
                                            isValid = false;
                                        } else if (email.trim() === "") {
                                            emailError.textContent = "Please enter an email address";
                                            isValid = false;
                                        }

                                        var phoneRegex = /^\d{10}$/                                        if (phone.trim() !== "" && !phoneRegex.test(phone)) {
                                            phoneError.textContent = "Please enter a valid 10-digit phone number";
                                            isValid = false;
                                        } else if (phone.trim() === "") {
                                            phoneError.textContent = "Please enter a phone number";
                                            isValid = false;
                                        }

                                        return isValid;
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

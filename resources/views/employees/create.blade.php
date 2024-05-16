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
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('employees.store') }}" method="POST" id="employee-form"
                                    onsubmit="validateForm()">
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
                                                <option value="" selected>Company default</option>
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
                                <script>
                                    $(document).ready(function() {
                                        // Validation on form submit (pressing Enter)
                                        $('#employee-form').submit(function(event) {
                                            event.preventDefault(); // Prevent the default form submission
                                            validateForm(); // Call your validation function
                                        });

                                        // DataTable initialization code
                                        $('#employee-table').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: "{{ route('employees.index') }}",
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
                                                }
                                            ]
                                        });
                                    });

                                    function validateForm() {
                                        var firstName = document.getElementById("first_name").value;
                                        var lastName = document.getElementById("last_name").value;
                                        var company = document.getElementById('company_id').value;
                                        var email = document.getElementById("email").value;
                                        var phone = document.getElementById("phone").value;

                                        var firstNameError = document.getElementById("first_name_error");
                                        var lastNameError = document.getElementById("last_name_error");
                                        var companyError = document.getElementById("company_id_error");
                                        var emailError = document.getElementById("emailerror");
                                        var phoneError = document.getElementById("phoneerror");

                                        // Clear previous errors
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

                                        var phoneRegex = /^\d{10}$/;
                                        if (phone.trim() !== "" && !phoneRegex.test(phone)) {
                                            phoneError.textContent = "Please enter a valid 10-digit phone number";
                                            isValid = false;
                                        } else if (phone.trim() === "") {
                                            phoneError.textContent = "Please enter a phone number";
                                            isValid = false;
                                        }
                                        if (isValid) {
                                            document.getElementById('employee-form').submit();
                                        }
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

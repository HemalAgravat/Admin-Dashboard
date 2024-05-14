@include('bootfile.nav')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Employee</title>
    <script>
        function validateForm() {
            var firstName = document.getElementById("first_name").value;
            var lastName = document.getElementById("last_name").value;
            var company = document.getElementById("company_id").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;

            var firstNameError = document.getElementById("first_name_error");
            var lastNameError = document.getElementById("last_name_error");
            var companyError = document.getElementById("company_id_error");
            var emailError = document.getElementById("email_error");
            var phoneError = document.getElementById("phone_error");

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

            return isValid;
        }
    </script>

</head>
<body>
   
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card" style="padding: 40px;">
                        <div class="col-10" style="margin-left: 100px;">
                            <div class="iq-header-title">
                                <h2 style="color: rgb(251, 134, 88)">Edit Employee</h2>
                                <form method="POST" action="{{ route('employees.update', $employee->id) }}"
                                    onsubmit="return validateForm()">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control " id="first_name" name="first_name"
                                            value="{{ $employee->first_name }}">
                                        <span id="first_name_error" style="color: rgb(65, 1, 156)"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="{{ $employee->last_name }}">
                                        <span id="last_name_error" style="color: rgb(65, 1, 156)"></span>

                                    </div>
                                    <div class="mb-3">
                                        <label for="company_id" class="form-label">Company</label>
                                        <select class="form-select" id="company_id" name="company_id">
                                            <option value="">Select Company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ $employee->company_id == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        <span id="company_id_error" style="color: rgb(65, 1, 156)"></span>

                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $employee->email }}">
                                        <span id="email_error" style="color: rgb(65, 1, 156)"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ $employee->phone }}">
                                        <span id="phone_error" style="color: rgb(65, 1, 156)"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

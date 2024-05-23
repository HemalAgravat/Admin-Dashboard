@include('bootfile.nav')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Employee</title>
    <script>
         document.addEventListener('DOMContentLoaded', function () {
            const firstNameField = document.getElementById('first_name');
            const lastNameField = document.getElementById('last_name');
            const emailField = document.getElementById('email');
            const phoneField = document.getElementById('phone');
            const submitBtn = document.querySelector('button[type="submit"]');

            firstNameField.addEventListener('input', validateForm);
            lastNameField.addEventListener('input', validateForm);
            emailField.addEventListener('input', validateForm);
            phoneField.addEventListener('input', validateForm);

            function validateForm() {
                let isValid = true;

                const firstName = firstNameField.value.trim();
                const lastName = lastNameField.value.trim();
                const email = emailField.value.trim();
                const phone = phoneField.value.trim();

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const phoneRegex = /^\d{10}$/;

                document.getElementById('first_name_error').textContent = firstName ? '' : 'Please enter First Name';
                document.getElementById('last_name_error').textContent = lastName ? '' : 'Please enter Last Name';

                if (!email) {
                    document.getElementById('email_error').textContent = 'Please enter an email address';
                    isValid = false;
                } else if (!emailRegex.test(email)) {
                    document.getElementById('email_error').textContent = 'Please enter a valid email address';
                    isValid = false;
                } else {
                    document.getElementById('email_error').textContent = '';
                }

                if (!phone) {
                    document.getElementById('phone_error').textContent = 'Please enter a phone number';
                    isValid = false;
                } else if (!phoneRegex.test(phone)) {
                    document.getElementById('phone_error').textContent = 'Please enter a valid 10-digit phone number';
                    isValid = false;
                } else {
                    document.getElementById('phone_error').textContent = '';
                }

                submitBtn.disabled = !isValid;
                return isValid;
            }

            // Initial validation check in case there are pre-filled values
            validateForm();
        });
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
                                    {{-- <div class="mb-3">
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

                                    </div> --}}
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $employee->email }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

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

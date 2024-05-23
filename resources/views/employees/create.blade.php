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
                                            <option value="" selected>Company default</option>
                                            @foreach ($com as $item)
                                               
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <span id="company_id_error" style="color: rgb(65, 1, 156)"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control " id="email" name="email">
                                        <span id="email_error" style="color: rgb(65, 1, 156)"></span>

                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control"id="phone" name="phone">
                                        <span id="phone_error" style="color: rgb(65, 1, 156)"></span>

                                    </div>
                                    <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>                                </form>
                                <script>
                                

                                        document.addEventListener('DOMContentLoaded', function() {
                                        const form = document.getElementById('employee-form');
                                        const firstNameField = document.getElementById('first_name');
                                        const lastNameField = document.getElementById('last_name');
                                        const companyField = document.getElementById('company_id');
                                        const emailField = document.getElementById('email');
                                        const phoneField = document.getElementById('phone');
                                        const submitBtn = document.getElementById('submit-btn');

                                        // Event listeners for blur events to show error messages
                                        firstNameField.addEventListener('blur', function() { showError(firstNameField, 'first_name_error'); });
                                        lastNameField.addEventListener('blur', function() { showError(lastNameField, 'last_name_error'); });
                                        companyField.addEventListener('blur', function() { showError(companyField, 'company_id_error'); });
                                        emailField.addEventListener('blur', function() { showError(emailField, 'email_error'); });
                                        phoneField.addEventListener('blur', function() { showError(phoneField, 'phone_error'); });

                                        // Event listeners for input events to validate form without showing errors
                                        firstNameField.addEventListener('input', validateForm);
                                        lastNameField.addEventListener('input', validateForm);
                                        companyField.addEventListener('input', validateForm);
                                        emailField.addEventListener('input', validateForm);
                                        phoneField.addEventListener('input', validateForm);

                                        form.addEventListener('submit', function(event) {
                                            if (!validateForm(true)) {
                                                event.preventDefault();
                                            }
                                        });

                                        function showError(field, errorFieldId) {
                                            const errorField = document.getElementById(errorFieldId);
                                            const value = field.value.trim();
                                            let errorMessage = '';

                                            if (field.id === 'email') {
                                                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                                if (!value) {
                                                    errorMessage = 'Please enter an email address';
                                                } else if (!emailRegex.test(value)) {
                                                    errorMessage = 'Please enter a valid email address';
                                                }
                                            } else if (field.id === 'phone') {
                                                const phoneRegex = /^\d{10}$/;
                                                if (!value) {
                                                    errorMessage = 'Please enter a phone number';
                                                } else if (!phoneRegex.test(value)) {
                                                    errorMessage = 'Please enter a valid 10-digit phone number';
                                                }
                                            } else {
                                                if (!value) {
                                                    errorMessage = `Please enter ${field.labels[0].innerText}`;
                                                }
                                            }

                                            errorField.textContent = errorMessage;
                                        }

                                        function validateForm(showErrors = false) {
                                            let isValid = true;

                                            const firstName = firstNameField.value.trim();
                                            const lastName = lastNameField.value.trim();
                                            const company = companyField.value.trim();
                                            const email = emailField.value.trim();
                                            const phone = phoneField.value.trim();

                                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                            const phoneRegex = /^\d{10}$/;

                                            if (!firstName && showErrors) {
                                                document.getElementById('first_name_error').textContent = 'Please enter First Name';
                                                isValid = false;
                                            } else {
                                                document.getElementById('first_name_error').textContent = '';
                                            }

                                            if (!lastName && showErrors) {
                                                document.getElementById('last_name_error').textContent = 'Please enter Last Name';
                                                isValid = false;
                                            } else {
                                                document.getElementById('last_name_error').textContent = '';
                                            }

                                            if (!company && showErrors) {
                                                document.getElementById('company_id_error').textContent = 'Please select a Company';
                                                isValid = false;
                                            } else {
                                                document.getElementById('company_id_error').textContent = '';
                                            }

                                            if (!email) {
                                                if (showErrors) {
                                                    document.getElementById('email_error').textContent = 'Please enter an email address';
                                                }
                                                isValid = false;
                                            } else if (!emailRegex.test(email)) {
                                                if (showErrors) {
                                                    document.getElementById('email_error').textContent = 'Please enter a valid email address';
                                                }
                                                isValid = false;
                                            } else {
                                                document.getElementById('email_error').textContent = '';
                                            }

                                            if (!phone) {
                                                if (showErrors) {
                                                    document.getElementById('phone_error').textContent = 'Please enter a phone number';
                                                }
                                                isValid = false;
                                            } else if (!phoneRegex.test(phone)) {
                                                if (showErrors) {
                                                    document.getElementById('phone_error').textContent = 'Please enter a valid 10-digit phone number';
                                                }
                                                isValid = false;
                                            } else {
                                                document.getElementById('phone_error').textContent = '';
                                            }

                                            submitBtn.disabled = !isValid;
                                            return isValid;
                                        }

                                        // Initial validation check without showing errors
                                        validateForm();
                                    });
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

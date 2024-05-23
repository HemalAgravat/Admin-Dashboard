<!-- resources/views/companies/create.blade.php -->
@include('bootfile.nav')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Company</title>
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const nameField = document.getElementById('name');
            const emailField = document.getElementById('email');
            const logoField = document.getElementById('logo');
            const websiteField = document.getElementById('website');
            const statusField = document.getElementById('status');
            const createdAtField = document.getElementById('created_at');
            const submitBtn = document.querySelector('button[type="submit"]');

            //    // Get today's date
            //    const today = new Date();
            // const yyyy = today.getFullYear();
            // const mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            // const dd = String(today.getDate()).padStart(2, '0');
            // const minDate = `${yyyy}-${mm}-${dd}`;


            nameField.addEventListener('input', validateForm);
            emailField.addEventListener('input', validateForm);
            logoField.addEventListener('change', validateForm);
            websiteField.addEventListener('input', validateForm);
            statusField.addEventListener('change', validateForm);
            createdAtField.addEventListener('input', validateForm);

            function validateForm() {
                let nameValid = nameField.value.trim() !== '';
                let emailValid = isValidEmail(emailField.value);
                let logoValid = isImageFile(logoField.files[0]);
                let websiteValid = isValidUrl(websiteField.value);
                let statusValid = statusField.value !== '';
                let createdAtValid = createdAtField.value !== '';

                document.getElementById('nameError').textContent = nameValid ? '' : 'Please enter Name';
                document.getElementById('emailError').textContent = emailValid ? '' :
                    'Please enter a valid email address';
                document.getElementById('logoError').textContent = logoValid ? '' :
                    'Logo must be in JPEG, PNG, or JPG format';
                document.getElementById('websiteError').textContent = websiteValid ? '' :
                'Please enter a valid URL';
                document.getElementById('status_error').textContent = statusValid ? '' : 'Please select a status';
                document.getElementById('created_at_error').textContent = createdAtValid ? '' :
                    'Please select a created date';

                submitBtn.disabled = !(nameValid && emailValid && logoValid && websiteValid && statusValid &&
                    createdAtValid);
            }

            function isValidEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }

            function isImageFile(file) {
                if (!file) return true; // No file selected is also considered valid
                const validFormats = ["image/jpeg", "image/png", "image/jpg"];
                return validFormats.includes(file.type);
            }


            function isValidUrl(url) {
                try {
                    new URL(url);
                    return true;
                } catch (e) {
                    return false;
                }
            }
        });
    </script>
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card" style="padding: 40px;">
                        <div class="col-10" style="margin-left: 100px;">
                            <div class="iq-header-title">
                                <h2 style="color: rgb(251, 134, 88)">Create New Company</h2>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('companies.store') }}" method="POST"
                                    enctype="multipart/form-data" style="margin: auto" onsubmit="return validateForm()">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name') }}">
                                        <span id="nameError" style="color: rgb(251, 134, 88)"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ old('email') }}">
                                        <span id="emailError" style="color: rgb(251, 134, 88)"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Logo (minimum 100x100):</label>
                                        <input type="file" name="logo" id="logo" class="form-control-file"
                                            accept="image/*">
                                        <span id="logoError" style="color: rgb(251, 134, 88)"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website:</label>
                                        <input type="url" name="website" id="website" class="form-control"
                                            value="{{ old('website') }}">
                                        <span id="websiteError" style="color: rgb(251, 134, 88)"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            {{-- <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option> --}}
                                        </select>
                                        <div class="form-group">
                                            <label for="created_at">Created Date:</label>
                                            <input type="date" name="created_at" id="created_at" class="form-control"
                                                value="{{ old('created_at', date('Y-m-d')) }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

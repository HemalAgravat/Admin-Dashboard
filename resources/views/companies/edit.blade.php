@include('bootfile.nav')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameField = document.getElementById('name');
            const emailField = document.getElementById('email');
            const logoField = document.getElementById('logo');
            const websiteField = document.getElementById('website');
            const submitBtn = document.querySelector('button[type="submit"]');
    
            nameField.addEventListener('input', validateForm);
            emailField.addEventListener('input', validateForm);
            logoField.addEventListener('change', validateForm);
            websiteField.addEventListener('input', validateForm);
    
            function validateForm() {
                let nameValid = nameField.value.trim() !== '';
                let emailValid = isValidEmail(emailField.value);
                let logoValid = isImageFile(logoField.files[0]);
                let websiteValid = isValidUrl(websiteField.value);
    
                document.getElementById('nameError').textContent = nameValid ? '' : 'Please enter Name';
                document.getElementById('emailError').textContent = emailValid ? '' : 'Please enter a valid email address';
                document.getElementById('logoError').textContent = logoValid ? '' : 'Logo must be in JPEG, PNG, or JPG format';
                document.getElementById('websiteError').textContent = websiteValid ? '' : 'Please enter a valid URL';
    
                submitBtn.disabled = !(nameValid && emailValid && logoValid && websiteValid);
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
                                <h2 style="color: rgb(251, 134, 88)">Edit Company</h2>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('companies.update', $company->id) }}" method="POST"
                                    enctype="multipart/form-data"onsubmit="return validateForm()">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ $company->name }}">
                                        <span id="nameError" style="color: rgb(251, 134, 88)"></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ $company->email }}">
                                        {{-- @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror --}}

                                        <span id="emailError" style="color: rgb(251, 134, 88)"></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Logo (minimum 100x100):</label>
                                        <input type="file" name="logo" id="logo" class="form-control-file"
                                            accept="image/*">
                                        <img src="{{ asset('/storage/logo/' . $company->logo) }}" alt="Company Logo"
                                            style="max-width: 100px; max-height: 100px;">
                                        @error('logo')
                                            {{ $message }}
                                        @enderror
                                        <span id="logoError" style="color: rgb(251, 134, 88)"></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website:</label>
                                        <input type="url" name="website" id="website" class="form-control"
                                            value="{{ $company->website }}">
                                        @error('website')
                                            {{ $message }}
                                        @enderror
                                        <span id="websiteError" style="color: rgb(251, 134, 88)"></span>

                                    </div>

                                    <button id="submitBtn" type="submit" class="btn btn-primary">Update</button>
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

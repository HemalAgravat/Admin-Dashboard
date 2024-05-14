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
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var logo = document.getElementById("logo").files[0];
            var website = document.getElementById("website").value;
            var status = document.getElementById("status").value;
            var createdDate = document.getElementById("created_at").value;

            var nameError = document.getElementById("name_error");
            var emailError = document.getElementById("email_error");
            var logoError = document.getElementById("logo_error");
            var websiteError = document.getElementById("website_error");
            var statusError = document.getElementById("status_error");
            var createdDateError = document.getElementById("created_at_error");

            nameError.textContent = "";
            emailError.textContent = "";
            logoError.textContent = "";
            websiteError.textContent = "";
            statusError.textContent = "";
            createdDateError.textContent = "";

            var isValid = true;

            if (name.trim() === "") {
                nameError.textContent = "Please enter Name";
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
            if (logo) {
                var logoSize = logo.size;
                var minSize = 100 * 100; // Minimum size (100x100)
                if (logoSize < minSize) {
                    logoError.textContent = "Minimum logo size is 100x100";
                    isValid = false;
                }
            } else {
                logoError.textContent = "Please upload a logo";
                isValid = false;
            }

            if (website.trim() === "") {
                websiteError.textContent = "Please enter Website";
                isValid = false;
            } else {
                // Validate if website is a valid URL
                var urlRegex =
                    /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
                if (!urlRegex.test(website)) {
                    websiteError.textContent = "Please enter a valid URL";
                    isValid = false;
                }
            }

            if (status.trim() === "") {
                statusError.textContent = "Please select Status";
                isValid = false;
            }

            if (createdDate.trim() === "") {
                createdDateError.textContent = "Please enter Created Date";
                isValid = false;
            } else {
                // Validate if created date is not in the future
                var currentDate = new Date();
                var enteredDate = new Date(createdDate);
                if (enteredDate > currentDate) {
                    createdDateError.textContent = "Created Date cannot be in the future";
                    isValid = false;
                }
            }

            return isValid;
        }
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
                                    enctype="multipart/form-data" style="margin: auto"onsubmit="return validateForm()">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name') }}">
                                            @error('name')
                                            {{$message}}
                                            @enderror
                                        <span id="name_error" style="color: rgb(251, 134, 88)"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ old('email') }}">
                                            @error('email')
                                            {{$message}}
                                            @enderror
                                        {{-- <span id="email_error" style="color: rgb(251, 134, 88)"></span> --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Logo (minimum 100x100):</label>
                                        <input type="file" name="logo" id="logo" class="form-control-file"
                                            accept="image/*">
                                            @error('logo')
                                            {{$message}}
                                            @enderror
                                        <span id="logo_error" style="color: rgb(251, 134, 88)"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website:</label>
                                        <input type="url" name="website" id="website" class="form-control"
                                            value="{{ old('website') }}">
                                            @error('website')
                                            {{$message}}
                                            @enderror
                                        <span id="website_error" style="color: rgb(251, 134, 88)"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            {{-- <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option> --}}
                                        </select>
                                        @error('status')
                                        {{$message}}
                                        @enderror
                                        <span id="status_error" style="color: rgb(251, 134, 88)"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="created_at">Created Date:</label>
                                        <input type="date" name="created_Date" id="created_at" class="form-control"
                                            value="{{ old('created_at') }}">
                                            @error('created_Date')
                                            {{$message}}
                                            @enderror
                                        <span id="created_at_error" style="color: rgb(251, 134, 88)"></span>
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

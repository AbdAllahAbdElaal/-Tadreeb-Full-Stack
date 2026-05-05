<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up - +Tadreeb</title>
    <link rel="stylesheet" href="{{ asset('tadreeb/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">+Tadreeb</div>
                <h2>Create Your Account</h2>
                <p>Sign up as a University or Company user</p>
            </div>

            <form id="signupForm" onsubmit="handleSignUp(event)">
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" id="username" name="username" placeholder="John Doe" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
                </div>

                <div class="form-group">
                    <label for="comp_name">Company Name</label>
                    <input type="text" id="comp_name" name="comp_name" placeholder="Company Name" required
                        style="width: 100%; padding: 8px;">
                </div>
                <div class="form-group">
                    <label for="comp_phone">Phone</label>
                    <input type="text" id="comp_phone" name="comp_phone" placeholder="Phone Number" required
                        style="width: 100%; padding: 8px;">
                </div>
                <div class="form-group">
                    <label for="comp_description">Description</label>
                    <input type="text" id="comp_description" name="comp_description" placeholder="Description" required
                        style="width: 100%; padding: 8px;">
                </div>
                <div class="form-group">
                    <label for="comp_address">Address</label>
                    <input type="text" id="comp_address" name="comp_address" placeholder="Address" required
                        style="width: 100%; padding: 8px;">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="********" required>
                </div>

                <button type="button" onclick="performStore()" class="btn btn-primary btn-lg" style="width: 100%;">
                    Add Company</button>
            </form>

            <div class="auth-footer">
                <a href="{{ route('companies.index') }}">Back to Companies</a>
            </div>
        </div>
    </div>

    <div id="toast-container"></div>

    <script src="{{ asset('tadreeb/js/app.js') }}"></script>
    <script src="{{ asset('tadreeb/js/crud.js') }}"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function performStore(){
            let formData = new FormData();

            // بيانات العضو (Member)
            formData.append('username', document.getElementById('username').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            formData.append('name', document.getElementById('comp_name').value);
            formData.append('phone', document.getElementById('comp_phone').value);
            formData.append('description', document.getElementById('comp_description').value);
            formData.append('address', document.getElementById('comp_address').value);

            // إرسال طلب واحد فقط للكنترولر
            store('/tadreeb/companies', formData);
        }

    </script>

</body>

</html>

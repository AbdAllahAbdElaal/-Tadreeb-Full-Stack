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
                    <label for="univ_name">University Name</label>
                    <input type="text" id="univ_name" name="univ_name" placeholder="University Name" required
                        style="width: 100%; padding: 8px;">
                </div>
                <div class="form-group">
                    <label for="univ_phone">Phone</label>
                    <input type="text" id="univ_phone" name="niv_phone" placeholder="Phone Number" required
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
                    Add University</button>
            </form>

            <div class="auth-footer">
                <a href="{{ route('universities.index') }}">Back to Universities</a>
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
            formData.append('name', document.getElementById('univ_name').value);
            formData.append('phone', document.getElementById('univ_phone').value);

            // إرسال طلب واحد فقط للكنترولر
            store('/tadreeb/universities', formData);
        }

    </script>

</body>

</html>

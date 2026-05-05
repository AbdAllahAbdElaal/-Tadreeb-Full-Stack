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
                <h2>Create Student Account</h2>
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
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="First Name" required
                        style="width: 100%; padding: 8px;">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name" required
                        style="width: 100%; padding: 8px;">
                </div>

                <div class="form-group">
                    <label for="student_phone">Phone</label>
                    <input type="text" id="student_phone" name="student_phone" placeholder="Phone Number" required
                        style="width: 100%; padding: 8px;">
                </div>
                <div class="form-group">
                    <label for="student_major">Major</label>
                    <input type="text" id="student_major" name="student_major" placeholder="Major" required
                        style="width: 100%; padding: 8px;">
                </div>

                <div class="form-group">
                    <label for="required_hours">Required Hours</label>
                    <input type="text" id="required_hours" name="required_hours" placeholder="Required Hours" required
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
                    Add Student</button>
            </form>

            <div class="auth-footer">
                <a href="{{ route('university.my-students') }}">Back to My Students</a>
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
            formData.append('first_name', document.getElementById('first_name').value);
            formData.append('last_name', document.getElementById('last_name').value);
            formData.append('phone', document.getElementById('student_phone').value);
            formData.append('major', document.getElementById('student_major').value);
            formData.append('required_hours', document.getElementById('required_hours').value);
            formData.append('university_id', '{{ auth()->user()->organization->university->id }}');

            // إرسال طلب واحد فقط للكنترولر
            store('/tadreeb/students', formData);
        }

    </script>

</body>

</html>

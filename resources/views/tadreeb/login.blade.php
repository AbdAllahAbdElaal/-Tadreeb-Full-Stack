@extends('tadreeb.login-parent')


@section('title' , 'Login')


@section('content')
<div class="auth-header">
    <div class="logo">+Tadreeb</div>
    <h2>Welcome Back</h2>
    <p>Sign in to your account to continue</p>
</div>

<form id="loginForm" onsubmit="performLogin(event)">
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
    </div>

    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
        <label style="display: flex; align-items: center; font-weight: normal; margin: 0;">
            <input id="rememberMe" type="checkbox" style="width: auto; margin-right: 8px;">
            Remember me
        </label>
        <a href="{{ route('forgot-password') }}" style="color: #4a90e2; text-decoration: none; font-size: 14px;">Forgot
            Password?</a>
    </div>

    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Sign In</button>
</form>

<div class="auth-footer">
    <p>Don't have an account? <a href="{{ route('members.create') }}">Sign Up</a></p>
</div>

<div style="margin-top: 30px; padding-top: 30px; border-top: 1px solid #e0e6ed;">
    <p style="font-size: 12px; color: #6c757d; text-align: center; margin-bottom: 15px;">Demo Accounts:</p>
    <div style="font-size: 12px; color: #6c757d;">
        <p><strong>Admin:</strong> admin@tadreeb.com</p>
        <p><strong>University:</strong> university@tadreeb.com</p>
        <p><strong>Company:</strong> company@tadreeb.com</p>
        <p><strong>Student:</strong> student@tadreeb.com</p>
        <p style="margin-top: 10px; font-style: italic;">Password: demo123 (for all accounts)</p>
    </div>
</div>
@endsection



@section('script')
<script>
    function performLogin(event) {
        event.preventDefault();

        // 1. جلب القيم من الحقول
        let emailValue = document.getElementById('email').value;
        let passwordValue = document.getElementById('password').value;

        // هذا السطر يخبر Axios أن يأخذ مفتاح الحماية ويرسله مع الإيميل والباسورد
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // 2. إرسال البيانات للكنترولر
        axios.post('/tadreeb/login', {
            email: emailValue,
            password: passwordValue,
        })
        .then(function (response) {
            // توجيه المستخدم للوحة التحكم
            window.location.href = response.data.redirect;
        })
        .catch(function (error) {
            // التعامل مع رسائل الخطأ من الـ Controller أو الـ Validation
            let errorMessage = error.response.data.message || 'حدث خطأ غير متوقع';
            alert(errorMessage);
        });
    }
</script>

@endsection

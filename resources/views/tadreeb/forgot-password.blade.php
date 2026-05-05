@extends('tadreeb.login-parent')


@section('title' , 'Forgot Password')



    @section('content')

        <div class="auth-header">
            <div class="logo">+Tadreeb</div>
            <h2>Forgot Password?</h2>
            <p>Enter your email address and we'll send you a link to reset your password</p>
        </div>

        <form id="forgotPasswordForm" onsubmit="handleForgotPassword(event)">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Send Reset Link</button>
        </form>
<div id="toast-container"></div>

        <div class="auth-footer">
            <p>Remember your password? <a href="{{ route('login') }}">Sign In</a></p>
        </div>

    @endsection


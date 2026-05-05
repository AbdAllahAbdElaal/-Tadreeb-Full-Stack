@extends('tadreeb.login-parent')


@section('title' , 'Change Password')


    @section('content')

        <div class="auth-header">
            <div class="logo">+Tadreeb</div>
            <h2>Change Password</h2>
            <p>Create a new password for your account</p>
        </div>

        <form id="changePasswordForm" onsubmit="handleChangePassword(event)">
            <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter current password"
                    required>
            </div>

            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" required>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm New Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password"
                    required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Change Password</button>
        </form>

        <div class="auth-footer">
            <p><a href="login.html">Back to Login</a></p>
        </div>

    @endsection



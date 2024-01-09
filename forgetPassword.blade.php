
Function: Generate Email for Forget Password
Docstring: This function generates an email containing a link to reset the password for a user who has forgotten their password.
Purpose: This functionality is necessary in software development to provide a convenient and secure way for users to reset their forgotten passwords. It helps to improve the user experience and maintain the security of the application by allowing users to easily and securely regain access to their account. @extends('layouts.home')

@section('content')

<div class="inner-shade"></div>
<section class="sec-pb sec-log-regi">
    <div class="container">
        <h1>Forget Password Email</h1>
        
        You can reset password from the link:
        <a href="{{ route('frontend.showResetPasswordForm', $token) }}">Reset Password</a>
    </div>
</section>

@endsection

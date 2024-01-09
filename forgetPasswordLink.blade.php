 function: submitResetPasswordForm
  docstring: This function handles the submission of a reset password form for a user. It takes in the password and password confirmation and validates them before resetting the user's password.
  purpose: This functionality is important in software development as it allows users to reset their passwords in case they forget it or need to change it for security reasons. The function ensures that the password reset process is secure and only allows authorized users to change their password.@extends('layouts.home')

@section('content')

<div class="inner-shade"></div>
<section class="sec-pb sec-log-regi">
    <div class="container">
        <h1>Reset Password</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('frontend.submitResetPasswordForm') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            
            <div class="form-group">
                <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">
            </div>
            <button class="btn btn-primary btn-submit w-100" type="submit">Reset Password</button>
        </form>
    </div>
</section>

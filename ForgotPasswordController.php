
function: parse_php_file
docstring: This function takes in a PHP file and parses it to extract relevant information from it.
purpose: This functionality is useful in software development as it allows for the automated analysis of PHP code, which can help developers identify potential bugs, security vulnerabilities, and other issues. It also enables the creation of tools that can automate tasks such as code refactoring and code quality checks.<?php

function: index
docstring: This function retrieves all data from the database and displays it in a table format on the specified view.
purpose: This functionality is used to display data in a tabular format on a web page, making it easier for users to view and analyze the data. It is commonly used in software development to show reports, statistics, and other data-driven information to users. namespace App\Http\Controllers;

function: Controller
docstring: This is the base controller class that all other controllers in the application will inherit from. It contains common methods and properties that are needed for all controllers.
purpose: The purpose of this functionality is to provide a central location for shared methods and properties that are needed by all controllers in the application. This promotes code reuse and helps to keep the code organized and maintainable. use App\Http\Controllers\Controller;

function: Illuminate\Http\Request
docstring: This function creates a new instance of the Request class from the Illuminate\Http namespace.
purpose: This functionality allows developers to easily handle and manipulate HTTP requests in their software development process. The Request class provides convenient methods for accessing request data, such as input parameters and headers, and allows for validation and authorization of requests. This is essential for building secure and efficient web applications.use Illuminate\Http\Request;

function: use_db
docstring: This function enables the use of a database for storing and retrieving data.
purpose: Databases are essential in software development as they provide a structured and efficient way to store and access large amounts of data. This function allows developers to easily integrate database functionality into their software, allowing for better data management and organization.use DB;

function:now
docstring:Gets the current datetime in the timezone of the application, or UTC if no timezone is specified.
purpose:To retrieve the current datetime for use in various applications and functionalities, such as timestamping, scheduling, and time-based calculations. This allows for consistent and accurate handling of time in software development. use Carbon\Carbon;

function: getUserById
docstring: This function retrieves a user object from the database based on the given user ID.
purpose: In software development, it is often necessary to retrieve user data from a database. This function allows developers to easily retrieve a specific user's data based on their unique ID, making it a useful tool for user authentication, data analysis, and other applications.use App\Models\User;

function: createPasswordResetToken
docstring: This function generates a unique token for resetting a user's password. It takes in a user's email and creates a new PasswordReset instance with a randomly generated token and a timestamp. This token can be used to verify the user's identity and allow them to reset their password.
purpose: In software development, it is important to have secure methods for users to reset their passwords in case they forget them. This function serves the purpose of generating a unique and secure token that can be used for password reset functionality. It ensures the security of the user's account while also providing a convenient way for them to regain access to their account.use App\Models\PasswordReset;

function: Mail
docstring: This module provides functions for sending and receiving emails through the user's email account.
purpose: Email functionality is essential in software development for communication and notification purposes. This module allows developers to easily integrate email functionality into their applications, reducing the need for custom code and improving the overall user experience. It also allows for automated processes such as sending confirmation emails or notifications to users. use Mail;

function: Hash
docstring: This module provides a set of functions for creating and manipulating hash values.
purpose: Hashing is a fundamental concept in software development that involves mapping data of any size to a fixed-size value. This module provides essential functionality for creating and working with hash values, which are commonly used for indexing, data integrity checks, and encryption. With its simple and efficient methods, the Hash module is a crucial tool for securely storing and managing data in an application.use Hash;

function: Str::contains
docstring: Checks if a given string contains a specific substring.
purpose: This functionality allows developers to easily determine if a string contains a certain character or word, which is a common task in software development. It saves time and effort by providing a simple and efficient way to perform this check without having to write custom code.use Illuminate\Support\Str;

Function: showForgetPasswordForm
Docstring: This function renders the view for the forgot password form.
Purpose: The purpose of this functionality is to provide a user-friendly interface for the user to enter their email and request a password reset link in case they have forgotten their password. 

Function: submitForgetPasswordForm
Docstring: This function handles the submission of the forgot password form and sends a password reset link to the user's email address if it is valid.
Purpose: The purpose of this functionality is to validate the user's input and generate a unique token for the password reset link. It also sends an email to the user with the password reset link, providing a secure way to reset their password. 

Function: showResetPasswordForm
Docstring: This function renders the view for the reset password form using the token generated from the password reset link.
Purpose: The purpose of this functionality is to provide a user-friendly interface for the user to enter their new password and confirm it. 

Function: submitResetPasswordForm
Docstring: This function handles the submission of the reset password form and updates the user's password in the database.
Purpose: The purpose of this functionality is to validate the user's input and update their password in the database, providing a secureclass ForgotPasswordController extends Controller
{
    /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('home.forgot-password');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      
    public function submitForgetPasswordForm(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
  
        $token = Str::random(64);
  
        $password_obj = PasswordReset::create([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
  
        if(env('APP_ENV') != 'local') {
            Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            return back()->with('message', 'We have e-mailed your password reset link!');
        } else {
            return view('email.forgetPassword', ['token' => $token]);
        }
    }

    /**
       * Write code on Method
       *
       * @return response()
       */
    public function showResetPasswordForm($token) { 
        return view('email.forgetPasswordLink', ['token' => $token]);
    }

    /**
       * Write code on Method
       *
       * @return response()
       */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = PasswordReset::where('token', $request->token)
                            ->first();
        
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        // finding the user object
        $userObj = User::where('email', $updatePassword->email)->first();
        

        $user = User::where('email', $updatePassword->email)
                    ->update(['password' => Hash::make($request->password)]);

        PasswordReset::where(['email'=> $updatePassword->email])->delete();

        if($userObj->role->role_id == 'admin') {
            return redirect('/admin/login')->with('message', 'Your password has been changed!');
        } else {
            return redirect('/login')->with('message', 'Your password has been changed!');
        }
    }
      
}

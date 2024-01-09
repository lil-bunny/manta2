
function: php_open_tag
docstring: This function serves as the opening tag for a PHP script, indicating the start of PHP code.
purpose: In software development, PHP is a popular scripting language used for creating dynamic web content. The php_open_tag function allows developers to easily switch between HTML and PHP code within a single file, making it easier to integrate dynamic functionality into a website. This functionality is essential for creating dynamic and interactive web applications.<?php

function: index
docstring: This function is used to retrieve all the records from the database and display them in a paginated view.
purpose: This functionality is used to display a list of data in a structured and organized manner, making it easier for users to navigate and find the information they need. It is commonly used in software development to improve the user experience and provide efficient data management.namespace App\Http\Controllers;

function: getUserById
docstring: This function retrieves a user object from the database based on the provided user ID. If no user with the given ID is found, it returns null.
purpose: This functionality allows for easy retrieval of specific user data, which can be useful in various software development tasks such as authentication, user profile management, and data analysis. It simplifies the process of accessing and manipulating user data, improving the efficiency and accuracy of software development. use App\Models\User;

Function: GetRoleById
Docstring: This function retrieves a specific role from the database based on the given role ID.
Purpose: This functionality is useful in software development for managing user permissions and access control. It allows for the retrieval of a specific role, which can then be used to determine the level of access and privileges a user has within the system. This is important for maintaining security and ensuring that only authorized individuals have access to certain features or data.use App\Models\Role;

function: Illuminate\Http\Request
docstring: This class represents an HTTP request made to the server. It contains information such as the request method, URI, headers, and input data.
purpose: In software development, this class is used to access and manipulate information from an HTTP request. It provides a convenient way to handle incoming requests and extract relevant data for further processing. This helps in building web applications that can handle user input and respond accordingly.use Illuminate\Http\Request;

function: Auth
docstring: The Auth facade provides a simple and convenient way to manage authentication in Laravel applications. It allows users to login, logout, and check the current authentication status.
purpose: Authentication is an essential aspect of software development, especially for applications that require user login. The Auth facade streamlines the process of managing authentication, making it easier for developers to secure their applications and provide a seamless user experience. This functionality helps developers save time and effort by providing a centralized and standardized way to handle authentication in Laravel applications.use Illuminate\Support\Facades\Auth;

function: make 
docstring: Generates a secure hash value for a given string using a chosen hashing algorithm.
purpose: Hashing is a crucial security measure in software development to protect sensitive data such as passwords. The make function, provided by the Hash facade, allows developers to easily generate a hash value for a string using a reliable and secure algorithm, making it suitable for storing and comparing passwords in a database. This helps to prevent unauthorized access to user accounts and maintains the integrity of the system.use Illuminate\Support\Facades\Hash;

Function: Socialite::driver()
Docstring: This function is used to retrieve an instance of a Socialite driver based on the given driver name.
Purpose: In software development, the purpose of this functionality is to provide an easy and convenient way to access and utilize the various social media APIs for authentication and authorization. This saves developers from having to write code to handle the intricacies of each individual API and allows for a more streamlined and standardized approach to social media integration in applications. use Laravel\Socialite\Facades\Socialite;
 Function: loginWithGoogle
  Docstring: This function redirects the user to Google's login page for authentication using Socialite.
  Purpose: To allow users to login to the software using their Google account, providing a more convenient and secure authentication method. 

  Function: callbackFromGoogle
  Docstring: This function handles the callback from Google after the user has successfully logged in, retrieves the user's information, and creates or updates their account in the system.
  Purpose: To complete the login process and allow the user to access the software, using Google as the authentication provider. class GoogleController extends Controller
{
    
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            $is_user = User::where('email', $user->getEmail())->first();

            // fetching roles for customer
            $roles = Role::where('is_deleted', '=', 0)
                            ->where('status', '=', 1)
                            ->where('role_id', '=', 'customer')
                            ->get();
            foreach($roles as $role) {
                $role_id = $role->id;
            }
            
            if(!$is_user){
                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'full_name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId()),
                    'role_id' => $role_id
                ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }

            Auth::loginUsingId($saveUser->id);

            return redirect()->route('frontend.home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

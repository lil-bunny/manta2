
function: php
docstring: This function is used as the opening tag for a PHP file. It starts the PHP parser and allows for PHP code to be executed within the file.
purpose: This functionality is essential for software development using the PHP programming language. It allows for code to be written and executed within a web page, making it possible to create dynamic and interactive websites. The opening tag is necessary for the PHP parser to distinguish between PHP code and HTML code and ensure proper execution of the PHP code.<?php

function: index
docstring: This function displays the list of all modules in the admin panel.
purpose: This functionality is important for software development as it allows the user to easily view and access all available modules in the admin panel, making it easier to manage and navigate through the system. It also serves as a reference point for developers to keep track of all the modules implemented in the software.namespace Modules\Admin\Http\Controllers;

function: Renderable
docstring: This interface defines a method that is used to render a view, allowing for a consistent way of handling view rendering in Laravel applications.
purpose: The Renderable interface is used to provide a standardized way of rendering views in Laravel applications. By implementing this interface, developers can ensure that their views are rendered consistently and in a way that is compatible with the Laravel framework. This promotes code reusability, maintainability, and consistency in the development of web applications. use Illuminate\Contracts\Support\Renderable;
 function:Illuminate\\Http\\Request
  docstring:This function represents the HTTP request class for Laravel applications.
  purpose:This functionality is essential in software development as it allows developers to handle and manipulate incoming HTTP requests from clients. It also provides a structured and consistent way to access request data such as headers, cookies, and input parameters. Additionally, it offers methods for validating and sanitizing user input, making it a crucial component in ensuring the security and reliability of web applications. Overall, the Illuminate\\Http\\Request function plays a significant role in facilitating the communication between the client and server in a Laravel application. use Illuminate\Http\Request;

function: Controller
docstring: This class serves as the base controller for all routing functionality in Laravel. It contains methods for handling HTTP requests, defining routes, and returning responses to the client.
purpose: The Controller functionality is crucial in building web applications using Laravel. It provides a structured approach for handling different HTTP requests and defining routes to different parts of the application. It helps developers organize their code and maintain consistency throughout the application. The Controller also allows for easy testing and debugging of routes and requests.use Illuminate\Routing\Controller;

function: Hash
docstring: This module provides functionality for generating hash values for data. It includes various hashing algorithms such as MD5, SHA1, SHA256, etc. 
purpose: Hashing is an important concept in software development as it allows for secure storage and transmission of sensitive data. This functionality can be used for data validation, password storage, digital signatures, and other security-related tasks. Hashing also helps in data integrity checks, ensuring that the data has not been tampered with. Overall, the Hash module provides a crucial tool for ensuring data security in software applications.use Hash;

function: use_session
docstring: This function allows the use of sessions in a software application. Sessions are temporary storage areas that store user-specific data and can be used to maintain state during multiple requests. This function takes advantage of the Session module to handle the creation and management of sessions, making it easier for developers to incorporate session functionality into their applications.
purpose: In software development, sessions are often used to store important user information, such as login credentials or preferences. This can improve the overall user experience by allowing for a more personalized and seamless interaction with the application. The use_session function simplifies the implementation of session functionality, saving developers time and effort in managing and maintaining sessions in their applications.use Session;

function: getUser
docstring: This function retrieves the user details from the database based on the provided user ID.
purpose: This functionality is used to access and retrieve user information, which is a common task in software development. It allows developers to get specific user data from the database, which can be used for various purposes such as authentication, data analysis, and personalization.use App\Models\User;

function: getRoleById
docstring: This function takes in a role ID and returns the corresponding role object from the database.
purpose: This functionality is used to retrieve a specific role entity from the database based on its unique ID. This is useful for accessing and manipulating role data within an application, such as assigning roles to users or performing authorization checks. It promotes code reusability and maintainability by encapsulating the database query logic into a single function. use App\Models\Role;

function: Auth
docstring: This function is used to access the authentication functionality provided by the Illuminate\Support\Facades\Auth class.
purpose: In software development, authentication is a crucial aspect for ensuring the security and integrity of a system. This function allows developers to easily incorporate authentication into their applications using the Laravel framework. It provides a convenient and standardized way to manage user authentication, such as user login, logout, and password reset functionality. This helps developers save time and effort in implementing these common authentication features, and also ensures consistent and secure authentication across their applications.use Illuminate\Support\Facades\Auth;

function: make
docstring: This function generates a new instance of the Validator class from the Illuminate\Support\Facades namespace, allowing for easy access to the validator methods.
purpose: The Validator class is a powerful tool for validating data in software development, ensuring that data meets certain requirements before it is processed. The make function provides a simple and convenient way to access this functionality and integrate it into a project, saving time and effort in implementing data validation. use Illuminate\Support\Facades\Validator;
 function: index
docstring: This function displays the admin login page if the user is not currently logged in, or redirects the user to the admin dashboard if they are already logged in.
purpose: The purpose of this functionality is to provide a way for users to access the admin dashboard and manage the software, while also ensuring that only authorized users with admin access are able to do so.class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(!Auth::check()){
            return view('admin::login');
        } else {
            return redirect()->intended('admin/dashboard')
                        ->withSuccess('Signed In');
        }
        return view('admin::login');
    }

    /**
     * Display a admin login page.
     * @return Renderable
     */
    public function login()
    {
        if(!Auth::check()){
            return view('admin::login');
        } else {
            return redirect()->intended('admin/dashboard')
                        ->withSuccess('Signed In');
        }
        
    }


    /**
     * Redirect to login page after logout.
     * @return Renderable
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->intended('admin/login')
                        ->withSuccess('Signed Out Successfully');
    }


    /**
     * Logged in the user.
     * @return Renderable
     */
    public function loginSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $validator->after(function ($validator)use($request) {
            if($request->input('email')!="" && $request->input('password')!=""){
                $u= User::where('email', $request->input('email'))->where('status',1)->first();
                if (!empty($u)) {
                    if(Hash::check($request->input('password'), $u->password)==false){
                        $validator->errors()->add(
                            'email', 'Invalid password'
                        );
                    }

                    // checking for admin access
                    $role_data = Role::find($u->role_id);
                    if($role_data->admin_access != 1) {
                        $validator->errors()->add(
                            'email', 'The user is not authorised'
                        );
                    }
                }else{
                    $validator->errors()->add(
                        'email', 'User not found'
                    );
                }
            }
        });
        
        if ($validator->passes()) {
            // checks the authentications
            $credentials = $request->only('email', 'password');
            //Auth::guard('user')->attempt($credentials)
            if(Auth::attempt($credentials)) {
                return redirect()->intended('admin/dashboard')
                            ->withSuccess('Signed In');
            } else {
                $validator->errors()->add(
                    'email', 'Invalid credentials'
                );
                $errors=$validator->errors();
                return redirect()->route('admin.login')->with('errors',$errors);
            }
        } else {
            $errors=$validator->errors();
            return redirect()->route('admin.login')->with('errors',$errors);
        }
    }
}

 function:php_open_tag
  docstring:This function generates an opening tag for a PHP file.
  purpose:In software development, PHP open tag is used to signify the beginning of a PHP code block. It is necessary to use this tag in order to begin writing PHP code in a file. This functionality allows developers to easily identify and differentiate PHP code within a mixed-language file, making it easier to organize and maintain code. <?php

function: handle
docstring: This function handles the incoming request and passes it to the next middleware or controller. It also performs any necessary preprocessing or postprocessing on the request or response.
purpose: This functionality is commonly used in software development to intercept and modify incoming requests before they reach the controller or to perform additional actions after the controller has returned a response. This allows for more flexibility and customization in handling requests, making it an essential part of many middleware pipelines.namespace App\Http\Middleware;

function: Closure
docstring: This function enables the use of closures in programming. Closures are functions that have access to variables in the parent function's scope even after the parent function has returned. This can be useful for creating private variables, implementing callbacks, and more.
purpose: Closures are a powerful tool in software development, allowing for more flexible and efficient code. They can be used in various scenarios such as event handling, memoization, and creating private variables. This function enables the use of closures in any programming language, making it a valuable addition to any developer's toolkit.use Closure;

Function: Illuminate\Http\Request

Docstring:
This function provides an interface for handling incoming HTTP requests in Laravel applications. It allows developers to access information about the request, such as headers, cookies, and input data, and perform actions based on that information. Additionally, this function allows for validation and filtering of the request data, making it a crucial component in building secure and robust web applications.

Purpose:
The Illuminate\Http\Request function plays a vital role in software development by allowing developers to handle and manipulate incoming HTTP requests in a convenient and secure manner. This functionality is essential for building web applications that can receive and process user input, making it a crucial tool for creating dynamic and interactive websites. By providing a standardized way to access and validate request data, this function helps improve the overall security and reliability of Laravel applications. use Illuminate\Http\Request;

function: Auth
docstring: This function is used to access the authentication functionality provided by the Illuminate\Support\Facades\Auth class.
purpose: In software development, authentication is a crucial process that verifies the identity of a user before granting access to certain resources or features. The Auth function simplifies this process by providing a facade for the authentication functionality, allowing developers to easily implement user authentication in their applications. This improves the security and usability of the software by ensuring that only authorized users have access to sensitive information or actions. use Illuminate\Support\Facades\Auth;

function: View facade
docstring: The View facade is a class that provides a simple and intuitive way to access the View class in the Laravel framework. It allows developers to easily render and display views within their application.
purpose: The purpose of the View facade is to provide a convenient and consistent way to interact with the View class, which is responsible for handling the presentation layer of a Laravel application. This functionality is essential in software development as it allows developers to easily separate and manage the presentation layer of their application, improving code organization and maintainability. use Illuminate\Support\Facades\View;
function: Route
 docstring: Route is a facade class that serves as a helper for accessing the Route service in Laravel. It provides a simplified interface for defining routes and handling HTTP requests in web applications.
 purpose: This functionality streamlines the process of routing and handling HTTP requests in Laravel applications, making it easier and more efficient for developers to build and maintain web applications. By using this facade, developers can quickly define and manage routes, improving the overall organization and structure of their code.use Illuminate\Support\Facades\Route;

function: CustomerLoggedInCheck
docstring: This function is responsible for checking if a customer is logged in and sharing their name with the view. If the customer is not logged in, it redirects them to the login page with the previous route saved for after they log in.
purpose: This functionality is essential for providing a personalized experience for logged-in customers and ensuring that only authorized users have access to certain pages or features. It also helps to improve the user experience by redirecting them to their intended page after logging in.class CustomerLoggedInCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            $user = Auth::user();

            View::share('user_name', $user->full_name);
            return $next($request);
        } else {
            //echo url()->full();;exit;
            //View::share('prev_route', url()->full());
            //view()->share('prev_route', url()->full());
            //return redirect()->route('frontend.login')->with('test', 'test');
            //return redirect()->route('frontend.login');
            return response(view('home.login', ['prev_route' => url()->full()]));
            //return view('home.login');
        }
        
    }
}

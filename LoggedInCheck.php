
function: phpInterpreter
docstring: This function is used to interpret and execute PHP code. It takes in a string of PHP code as input and returns the result of the code execution.
purpose: The phpInterpreter function is an essential tool in software development as it allows for dynamic and interactive execution of PHP code. This functionality is crucial for creating dynamic and interactive websites and web applications. It also helps in debugging and testing PHP code during the development process. <?php

function: handle
docstring: This function handles the incoming HTTP request and calls the appropriate controller method based on the requested URI.
purpose: This functionality is essential for routing and directing incoming requests to the correct controller method. It helps in maintaining a structured and organized codebase while handling different endpoints and functionalities in a web application. Additionally, it allows for easy modification and expansion of the application's routes and endpoints. namespace Modules\Admin\Http\Middleware;

function: Closure
docstring: This function imports the Closure library into the current code, allowing for the use of Closure's features and tools.
purpose: In software development, Closure is a popular library that provides efficient tools for creating and maintaining complex JavaScript applications. By importing it into the code, developers can easily access its functions and streamline their development process. This functionality is especially useful for projects that require advanced JavaScript techniques and optimizations. use Closure;

function: Illuminate\Http\Request
docstring: This function is used to handle incoming HTTP requests in Laravel web applications. It is responsible for parsing and processing request data and providing access to request headers, cookies, and input parameters.
purpose: In software development, handling HTTP requests is a crucial aspect of building web applications. This function provides a convenient and standardized way to access request data, allowing developers to focus on implementing business logic rather than dealing with low-level HTTP details. By utilizing this function, developers can easily build robust and secure web applications using the Laravel framework.use Illuminate\Http\Request;

function: Auth
docstring: This function is used to access the authentication functionality provided by the Illuminate\Support\Facades\Auth class.
purpose: In software development, authentication is a vital process for verifying the identity of users accessing a system or application. The Auth function provides an easy and convenient way to implement authentication in Laravel applications, allowing developers to secure their application and control access to certain features or resources. It also provides various methods for user authentication, such as login, logout, and user registration, making it an essential tool for building secure and user-friendly applications.use Illuminate\Support\Facades\Auth;

function: View
docstring: A class that represents a template system for rendering views in a web application.
purpose: The View class allows developers to separate the presentation layer from the application logic, making it easier to manage and maintain the codebase. It provides a way to render HTML templates by passing data to be displayed in the views. This functionality is essential in software development as it promotes reusability, improves code organization, and enhances the overall user experience. use Illuminate\Support\Facades\View;

function: getMenu
docstring: This function retrieves the menu from the database and returns a list of menu items.
purpose: The getMenu function is used to retrieve and display the menu for users in a software application. This allows users to view and select from a list of available options, such as food items or features, within the application. By having a function specifically dedicated to retrieving the menu, it makes it easier to update and maintain the menu in the future without affecting other parts of the code. Additionally, this function can be reused in multiple places within the application, reducing the need for redundant code. use App\Models\Menu;

function: get_role_by_id
docstring: This function retrieves the role object with the given ID from the database.
purpose: This functionality allows for easy retrieval of a specific role in software development, which can be useful for assigning permissions or checking user access levels. It streamlines the process of querying the database and handling the returned data, making it an efficient and convenient tool for developers. use App\Models\Role;


function: get_new_notifications
docstring: This function retrieves all new notifications for the user.
purpose: In software development, notifications are an important way to inform users about important events or updates. This function helps to keep users informed by fetching all new notifications for them. This can improve user experience and keep them engaged with the application.use App\Models\Notification;

Function name: handle

Docstring: This function handles an incoming request and checks if the user is logged in. If the user is logged in, it checks if the user has admin access and if not, redirects the user to the home page. It also shares user information such as menus, notifications, and notification count with the view. If the user is not logged in, it redirects the user to the admin login page.

Purpose: This functionality ensures that only logged-in users with admin access can access certain pages or perform certain actions. It also shares important user information with the view, making it easily accessible for further processing. This helps in maintaining security and providing a seamless user experience. class LoggedInCheck
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

            // checking user has the admin access or not
            $role_data = Role::find($user->role_id);
            if($role_data->admin_access != 1) {
                return redirect()->route('frontend.home'); 
            }

            // fetching user informations
            $notification_count_unread = 0;
            $notifications = Notification::where('user_id', '=', $user->id)
                            ->orderBy('id', 'desc')
                            ->get();
            foreach($notifications as $notification) {
                if($notification->is_read == 0) {
                    $notification_count_unread++;
                }
            }

            View::share('menus_sidebar', $role_data->menus);
            View::share('notifications', $notifications);
            View::share('notification_count_unread', $notification_count_unread);
            View::share('user_name', $user->full_name);
            return $next($request);
        } else {
            return redirect()->route('admin.login');
        }
        
    }
}


function: php
docstring: This function is used to start the PHP code.
purpose: In software development, the PHP function is used to indicate the beginning of PHP code. This allows the server to recognize and process the code as PHP, rather than regular HTML. It is a crucial function in creating dynamic and interactive web pages. <?php


function: index
docstring: This function is used to display a list of items in the admin panel.
purpose: This functionality is essential for software development as it allows administrators to view and manage various items within the system, providing a centralized and organized overview of the data. This can be used for tasks such as adding, editing, or deleting items, as well as monitoring and analyzing data trends. By having a dedicated admin panel, this function helps to streamline and optimize the administrative tasks in a software system. namespace Modules\Admin\Http\Controllers;

function: Renderable
docstring: This interface defines a method for rendering a view. It is typically implemented by classes that represent a view in a web application.
purpose: The Renderable interface provides a standardized way for views to be rendered in a web application, allowing for easier development and maintenance of the application. It allows developers to focus on the functionality of the view, while the rendering process is handled by the underlying framework. This promotes code reusability and helps to keep the codebase organized. use Illuminate\Contracts\Support\Renderable;
 function: Illuminate\Http\Request
docstring: Illuminate\Http\Request(request)
purpose: Illuminate\Http\Request is used to create a new HTTP request instance. This allows developers to handle incoming HTTP requests and access the request parameters, headers, and body. This functionality is essential in web development as it allows developers to create dynamic and interactive web applications that can process and respond to user requests. It also allows for secure handling of sensitive information and validation of user input. use Illuminate\Http\Request;
 function: Illuminate
  docstring: Illuminate is a PHP framework that provides a variety of tools and libraries for web application development. It follows the Model-View-Controller (MVC) architectural pattern, allowing for separation of concerns and efficient development. It also includes a powerful routing system for mapping HTTP requests to controller actions.
  purpose: Illuminate is a crucial component in the software development process, providing developers with a robust and flexible framework for building web applications. By following the MVC pattern, it promotes clean and organized code, making it easier to maintain and update projects. The routing system allows for handling of complex HTTP requests and mapping them to specific controller actions, providing a structured and efficient approach to designing and implementing web applications. use Illuminate\Routing\Controller;

function: Auth
docstring: This function is used to access the authentication functionality provided by the Laravel framework. It provides methods for user authentication, authorization, and managing user sessions.
purpose: In software development, authentication is a crucial aspect to ensure the security and integrity of a system. The Auth function helps developers easily incorporate authentication features into their applications, saving time and effort. It also promotes best practices for user authentication, making it a reliable and trusted choice for securing web applications. use Illuminate\Support\Facades\Auth;

function: use_session
docstring: This function enables the use of sessions in a software application, allowing for the storage and retrieval of data specific to a user's session.
purpose: Sessions are an essential aspect of software development as they provide a way for applications to maintain user-specific data and state, such as login information, shopping cart contents, and preferences. The use_session function simplifies this process by providing a pre-defined method for utilizing sessions in a software application. This allows developers to easily incorporate session functionality into their code, enhancing the overall user experience and improving the security and efficiency of their application.use Session;

function: getSetting
docstring: This function retrieves the value of a specific setting from the database.
purpose: This functionality is used to retrieve and access specific settings in a software application. It allows developers to easily access and use different configurations and options for their application without hardcoding them into the code. This not only makes the code more flexible and maintainable, but also allows for easy customization for different environments or user preferences.use App\Models\Setting;

function: use_validator
docstring: This function checks whether a given input is valid according to a set of specified rules.
purpose: The use_validator function is used to validate user inputs in software development. It helps ensure that the data entered by users meets certain standards and criteria, such as format, length, and type. This ensures data integrity and helps prevent errors or unexpected behaviors in the software. The use_validator function is commonly used in form validation, data validation, and user input validation in various types of software applications. use Validator;

Function name: index
Docstring: This function is responsible for fetching the settings data and displaying it on the settings page. It also assigns the options for sending a site dump and passes them to the view for display. 
Purpose: The purpose of this functionality is to allow users to view and update their site settings easily. It provides a centralized location for managing site settings, making it more efficient for users to make changes as needed. 

Function name: update_setting
Docstring: This function is responsible for updating the settings record in the database. It first validates the input data and then updates the record with the new information. 
Purpose: The purpose of this functionality is to allow users to update their site settings according to their needs. It ensures that the settings are accurately and securely saved in the database, providing a reliable way for users to manage their site settings. class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        // fetching the settings data
        $settings_data = Setting::latest()->first();
        
        
        // assigning the dump options
        $send_dump_options = [
            'yes' => 'yes',
            'no' => 'no'
        ];
        
        return view('admin::setting.add', ['send_dump_options' => $send_dump_options, 'settings_data' => $settings_data]);
    }


    

    /**
     * Adds city record
     * @return Renderable
     */
    public function update_setting(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'send_site_dump' => 'required|max:255',
        ]);
        
        if ($validator->passes()) {
            // fetching the user data wrt id
            $model= Setting::latest()->first();

            // creating user data updation array
            $model->send_site_dump = $request->input('send_site_dump');
            $model->user_id = auth()->user()->id;

            // update user record
            $model->save();
        } else {
            $errors=$validator->errors();
            return redirect()->route('admin.setting')->with('errors',$errors);
        }

        return redirect()->intended('admin/settings')->withSuccess('Settings updated successfully');
    }

    


    
}

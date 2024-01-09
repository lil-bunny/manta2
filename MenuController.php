
function: parse_php
docstring: This function takes in a PHP file as input and parses it line by line to extract information and store it in a structured format.
purpose: The parse_php function is useful in software development for parsing PHP files and extracting relevant information such as variables, functions, and classes. This information can then be used for analysis, debugging, or other purposes in the development process. It helps to streamline the process of understanding and working with PHP code, making it more efficient and organized.<?php

function: index
docstring: This function is used to retrieve all the data from the database and display it in a paginated format.
purpose: The purpose of this functionality is to provide an easy way for developers to view and manage the data in the admin panel of the software. It allows for efficient retrieval and display of data, making it easier for developers to make changes and updates as needed. This function is a key component in the development of any software that requires an admin panel for data management.namespace Modules\Admin\Http\Controllers;

Function: Renderable

Docstring:
This function is part of the Illuminate\Contracts\Support interface. It is used to mark a class as "renderable", which means that it can be converted into a string representation for display. Classes implementing this interface must have a render method that returns a string.

Purpose:
The Renderable function is used in software development to standardize the process of converting objects into a displayable format. By implementing this interface, developers can ensure that objects can be easily rendered for user-facing interfaces, such as web pages or command line outputs. This helps to improve the consistency and maintainability of the codebase. Additionally, by using the Renderable function, developers can easily swap out different renderable classes without having to make changes to the code that calls them. Overall, the Renderable function enhances the flexibility and usability of software development. use Illuminate\Contracts\Support\Renderable;

function: Request
docstring: Represents an HTTP request.
purpose: The Request class is used to represent an HTTP request in Laravel's framework. It provides methods for accessing and manipulating the data and parameters of the request, such as the request body and headers. This functionality is crucial for handling user input and making API calls in web applications.use Illuminate\Http\Request;

function: Controller
docstring: This class acts as the base controller for all routing functionality in Laravel. It handles the communication between the application and the server, allowing for the processing of HTTP requests and the generation of appropriate responses.
purpose: The Controller class is a fundamental part of the Laravel framework and serves as the foundation for handling routing in web applications. It provides a centralized location for handling incoming requests, allowing for efficient and organized development of software. By extending this class, developers can easily create and manage routes, improving the overall structure and functionality of their projects. use Illuminate\Routing\Controller;

function: Auth
docstring: This function is used to access the authentication functionality provided by the Illuminate\Support\Facades\Auth class.
purpose: Authentication is a crucial aspect of software development, as it allows for secure access to certain features or resources based on user credentials. This function provides a convenient way to access authentication methods and functionality, making the process of implementing and managing user authentication easier for developers. It also helps to ensure that proper security measures are in place to protect user data and sensitive information. use Illuminate\Support\Facades\Auth;

function: Session

docstring: This function is a part of the Session module and is used for managing user sessions in software applications. It provides functionality for creating, updating, and deleting user sessions, as well as retrieving session information and setting session variables. 

purpose: In software development, sessions are used to maintain stateful interactions with users. This function allows for efficient management of user sessions, enabling the application to store and retrieve user-specific data. This is particularly useful for web applications that require user authentication and personalization. use Session;

function: getMenuItems
docstring: Returns a list of all menu items from the database.
purpose: This functionality allows for easy access to all menu items in the database, making it convenient for developers to retrieve and display them in their software applications. This can be useful for creating dynamic menus or displaying menu items in an online ordering system.use App\Models\Menu;
 function:use_validator
docstring:This function is used to validate the accuracy and completeness of data input by users and to prevent any invalid or malicious data from being stored or processed by the software. It utilizes various rules and constraints to check the data and provides feedback to the user if any errors are found.
purpose:
In software development, data validation is a crucial step to ensure the integrity and security of the software. The use_validator function plays a vital role in this process by validating user input data and preventing potential errors or vulnerabilities. By providing comprehensive feedback, it helps to improve the overall quality and reliability of the software.use Validator;

function: index
docstring: Retrieves a list of all menus based on the provided search filters and displays them in a paginated view.
purpose: This functionality allows users to search for specific menus and view them in a user-friendly manner, making it easier to manage and navigate through a large amount of data. 

function: add
docstring: Displays the template for adding a new menu.
purpose: This functionality provides a user-friendly interface for adding new menus, making it easier and more efficient to create new menu records. 

function: create_menu
docstring: Validates the input data and creates a new menu record if validation passes. 
purpose: This functionality ensures that all required fields are filled in and unique values are provided before creating a new menu record, helping to maintain data integrity and prevent errors. 

function: edit
docstring: Displays the template for editing an existing menu.
purpose: This functionality provides a user-friendly interface for modifying an existing menu, making it easier to update and maintain menu records. 

function: update_menu
docstring: Validates the input data and updates the specified menu record if validation passes.
purpose: This functionality ensures that all required fields are filled in and unique values are provided before updating a menu record, helping to maintain data integrityclass MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $filters = [
            'menu_name' => $request->query('menu_name'),
            'status' => $request->query('status'),
        ];

        // fetching city lists
        $menus = Menu::sortable()->where('menus.is_deleted', '=', 0);
        
        // checks if search filters are set
        if($filters['menu_name'] != '') {
            $menus->where('menus.title', 'like', '%'.$filters['menu_name'].'%');
        }
        if($filters['status'] != '') {
            $menus->where('menus.status', '=', $filters['status']);
        }
        $menus = $menus->paginate(10);
        
        return view('admin::menu.index', ['menus'=>$menus, 'filters' => $filters]);
    }


    /**
     * Display Add city template
     * @return Renderable
     */
    public function add()
    {
        return view('admin::menu.add');
    }

    /**
     * Adds city record
     * @return Renderable
     */
    public function create_menu(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:cities|max:255',
            'route' => 'required|max:255',
        ]);
        
        if ($validator->passes()) {
            // create user record
            Menu::create([
                'title' => $request->input('name'),
                'route' => $request->input('route'),
                'status' => $request->input('status'),
            ]);
        } else {
            $errors=$validator->errors();
            return redirect()->route('admin::menu_add')->with('errors',$errors);
        }

        return redirect()->intended('admin/menus')->withSuccess('Menu created successfully');
    }

    /**
     * Display Edit city template
     * @return Renderable
     */
    public function edit($id)
    {
        // fetching user details
        $menu_data = Menu::find($id);
                    
        return view('admin::menu.edit', ['menu_data' => $menu_data]);
    }


    /**
     * Updates city record
     * @return Renderable
     */
    public function update_menu(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'route' => 'required|max:255',
        ]);

        
        if ($validator->passes()) {
            // fetching the city data wrt id
            $model= Menu::find($id);

            // creating city data updation array
            $model->title = $request->input('name');
            $model->route = $request->input('route');
            $model->status = $request->input('status');

            // update user record
            $model->save();

            return redirect()->intended('admin/menus')->withSuccess('Menu updated successfully');
        } else {
            $errors=$validator->errors();
            return redirect()->route('admin::menu_edit', ['id' => $id])->with('errors',$errors);
        }
    }


    /**
     * Soft delete city record
     * @return Renderable
     */
    public function menu_delete(Request $request, $id)
    {
        // fetching the city data wrt id
        $model= Menu::find($id);

        // creating city data updation object
        $model->is_deleted = 1;
        
        // update city record
        $model->save();

        return redirect()->intended('admin/menus')->withSuccess('Menu deleted successfully');
    }
}

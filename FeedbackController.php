
function: php_open_tag
docstring: This function generates a PHP open tag, which is used to denote the start of a PHP code block.
purpose: The purpose of this functionality is to allow developers to easily start a PHP code block within their files, making it clear that the code following the opening tag is written in PHP. This is a common practice in software development, especially for web development, where PHP is often used for server-side scripting. The use of a standard open tag also helps with code readability and organization.<?php

function: index
docstring: This function is used to retrieve and display all the items in the specified namespace.
purpose: In software development, this functionality is used to provide a list of all the items available in a specific namespace. This helps developers to easily navigate and access the resources within the namespace, making it easier to work with and manage the codebase. namespace Modules\Admin\Http\Controllers;

function: Renderable 
docstring: This interface defines a method that returns a rendered view as a string. 
purpose: The Renderable interface is used to define a common method for returning rendered views in various software development frameworks. It allows for a standardized approach to rendering views and improves the reusability and maintainability of code. Implementing this interface also ensures that the rendered view is returned as a string, making it easier to pass and manipulate in different parts of the application. use Illuminate\Contracts\Support\Renderable;

function: Request
docstring: Represents an HTTP request
purpose: The Request class is used to handle incoming HTTP requests in a web application. It provides methods to access request data such as headers, cookies, and form input. This functionality is essential in software development as it allows developers to interact with and retrieve data from incoming requests, which is necessary for building dynamic and interactive web applications.use Illuminate\Http\Request;

function: Illuminate\Routing\Controller
docstring: This class serves as the base controller for all routing functionality in the Laravel framework. It provides methods for handling HTTP requests and returning responses, as well as for defining and managing routes for different endpoints. It also allows for middleware to be applied to specific routes or groups of routes.
purpose: The Illuminate\Routing\Controller class is a crucial component in the Laravel framework for handling routing and request/response logic. By providing a base controller, it allows developers to easily create and manage routes and handle different types of incoming requests. This functionality is essential in software development as it enables the proper handling and organization of HTTP requests in web applications.use Illuminate\Routing\Controller;

function name: Auth

docstring: This function is a facade for the AuthManager class provided by the Laravel framework. It allows for easy access to commonly used authentication methods, such as login, logout, and user authentication.

purpose: The purpose of this functionality is to simplify the process of implementing authentication in web applications. By using the Auth facade, developers can easily access and utilize the authentication methods provided by the AuthManager class without having to manually instantiate the class. This improves the efficiency and readability of code, making it a valuable tool in software development. use Illuminate\Support\Facades\Auth;

function: Session
docstring: This function allows the creation and management of sessions in a software application. Sessions are used to store user-specific data and settings, allowing for a personalized and efficient user experience.
purpose: Sessions are a crucial component in software development as they provide a way to maintain user information throughout their interactions with the application. This functionality helps improve user experience and enables the application to remember user preferences, leading to a more efficient and personalized experience. use Session;

function: create_feedback
docstring: This function creates a new feedback object and saves it in the database.
purpose: This functionality allows users to submit feedback on the software, which can be used for improving and enhancing the overall user experience. It also helps in identifying any bugs or issues in the software. This is an important aspect of software development as it helps in continuously improving and updating the software to meet user needs and preferences. use App\Models\Feedback;

function: get_area_by_name
docstring: This function takes in a name as a parameter and retrieves the corresponding Area object from the database. If no matching Area is found, it returns null.
purpose: In software development, this functionality is useful for retrieving specific data from a database. In this case, it allows for easy access to an Area object by its name, which can be helpful in various applications such as location-based services or data analysis. It also promotes code reusability and organization by encapsulating the logic for retrieving an Area object into a single function.use App\Models\Area;

function: getUserById
docstring: Returns a User object with the given user ID if it exists, otherwise returns null.
purpose: This functionality allows for easy retrieval and manipulation of user data in software development. It can be used for tasks such as user authentication, profile management, and data analysis. use App\Models\User;

function: create_notification
docstring: This function creates a new notification object and saves it to the database. It takes in parameters such as the recipient, sender, message, and notification type. The notification will also be associated with a specific user or group, depending on the recipient.
purpose: Notifications play a crucial role in software development as they provide a way for the system to communicate important information to users. This function allows for the creation of notifications, which can be used to inform users about various events or updates within the system. This helps to improve user experience and keep them informed about important changes or actions that may affect them. Additionally, notifications can also be used for tracking and auditing purposes. use App\Models\Notification;

function: Validator
docstring: This validator function is used to check the validity of input data according to a set of predetermined rules. It takes in input data and checks it against a specified set of criteria, returning a boolean value indicating whether the data is valid or not.
purpose: In software development, it is important to ensure that all input data is valid and meets certain standards before it is processed. This validator function helps to ensure data integrity and improve the overall quality and reliability of software systems. It is commonly used in form validation, data validation, and input validation in web development, database management, and other software applications. use Validator;

function: index
docstring: This function renders the index page for the feedback management section in the admin panel. It fetches and filters the feedback data based on user input and displays it in a paginated format. It also fetches the list of areas and users for filtering purposes.
purpose: To display and manage feedback data in the admin panel, allowing for easy filtering and pagination for better user experience. 

function: edit
docstring: This function displays the edit page for a specific feedback entry, allowing for editing and updating of the selected feedback data. It also updates the notification status for the specific feedback.
purpose: To provide a user-friendly interface for editing and updating feedback data in the admin panel. 

function: update_feedback
docstring: This function updates the status of a specific feedback entry based on user input. It also saves the updated data to the database.
purpose: To allow for easy and efficient updating of feedback status in the admin panel, providing better control and management of feedback data. 

function: feedback_delete
docstring: This function soft deletes a specific feedback entry by setting the "is_deleted" flag to 1.
purpose: To provide a way to delete unwanted or irrelevant feedback data without permanently removing it from the database, ensuring dataclass FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $filters = [
            'user_id' => $request->query('user_id'),
            'area_id' => $request->query('area_id'),
            'status' => $request->query('status'),
        ];

        // fetching city lists
        $feedbacks = Feedback::sortable()->where('feedbacks.is_deleted', '=', 0);
        
        // checks if search filters are set
        if($filters['user_id'] != '') {
            $feedbacks->where('feedbacks.user_id', '=', $filters['user_id']);
        }
        if($filters['area_id'] != '') {
            $feedbacks->where('feedbacks.area_id', '=', $filters['area_id']);
        }
        if($filters['status'] != '') {
            $feedbacks->where('feedbacks.status', '=', $filters['status']);
        }
        $feedbacks = $feedbacks->orderBy('id', 'desc')->paginate(10);
        
        // fetching areas
        $areas = Area::where('is_deleted', '=', 0)
                            ->where('status', '=', 1)->get();
        
        $users = User::where('is_deleted', '=', 0)
                            ->where('status', '=', 1)->get();

        return view('admin::feedback.index', ['feedbacks'=>$feedbacks, 'users'=>$users, 'areas' => $areas, 'filters' => $filters]);
    }


    

    

    /**
     * Display Edit city template
     * @return Renderable
     */
    public function edit($id)
    {
        // updating nottifications
        Notification::where("object_id",$id)->where("is_read",0)->where("type", "feedback")->update(array('is_read' => 1));
        
        // fetching user details
        $feedback_data = Feedback::find($id);
                    
        return view('admin::feedback.edit', ['feedback_data' => $feedback_data]);
    }


    /**
     * Updates city record
     * @return Renderable
     */
    public function update_feedback(Request $request, $id)
    {        
            // fetching the city data wrt id
            $model= Feedback::find($id);

            // updating status
            $model->status = $request->input('status');

            // update user record
            $model->save();
            return redirect()->intended('admin/feedbacks')->withSuccess('Feedback approved successfully');
    }


    /**
     * Soft delete city record
     * @return Renderable
     */
    public function feedback_delete(Request $request, $id)
    {
        // fetching the feedback data wrt id
        $model= Feedback::find($id);

        // creating city data updation object
        $model->is_deleted = 1;
        
        // update city record
        $model->save();

        return redirect()->intended('admin/feedbacks')->withSuccess('Feedback deleted successfully');
    }
}

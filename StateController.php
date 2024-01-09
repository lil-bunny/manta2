
function: php_open_tag
docstring: This function is used to open a PHP code block and indicate the beginning of PHP code.
purpose: In software development, this functionality is used to start a PHP code block and allow for the execution of PHP code within a file. This is important for creating dynamic and interactive web pages.<?php

function: index
docstring: This function retrieves the list of all admin modules and their corresponding controllers.
purpose: This functionality allows for easy management and navigation of admin modules in a software application, improving the overall organization and structure of the codebase. It also enables easier debugging and troubleshooting of any issues related to admin modules.namespace Modules\Admin\Http\Controllers;

function: Renderable
docstring: This interface represents a contract for classes that are capable of rendering content to be displayed to the user.
purpose: In software development, the Renderable interface is used to standardize the process of rendering content in different applications. By implementing this interface, classes can ensure that they have the necessary methods to display content in a consistent manner, making it easier to integrate with other systems and components. It also promotes code reusability and maintainability by providing a clear contract for how content should be rendered.use Illuminate\Contracts\Support\Renderable;

function: Illuminate\Http\Request;
docstring: This is a class representing an HTTP request in the Laravel framework. It handles the incoming HTTP request and provides methods to access and manipulate the request data.
purpose: This functionality is used to handle HTTP requests in the Laravel framework, allowing developers to easily work with incoming data from clients and perform necessary actions based on the request. It is a crucial component in building web applications and APIs.use Illuminate\Http\Request;

Function: Illuminate\\Routing\\Controller
Docstring: This function is used to generate a controller class for routing in the Illuminate framework. It extends the base controller class and provides methods for handling requests and responses.
Purpose: This functionality is essential for software development as it allows for the creation of controllers that can handle incoming requests and generate appropriate responses. This is crucial for building robust and dynamic web applications. Moreover, it follows the MVC (Model-View-Controller) architecture, promoting separation of concerns and making code more maintainable.use Illuminate\Routing\Controller;

function: getState
docstring: Takes in a state code and returns the corresponding State model object.
purpose: This function is used to retrieve a specific state's information from the database. It is helpful in software development as it allows for easy access and manipulation of state data without having to write complex database queries.use App\Models\State;

function: use_validator
docstring: This function utilizes the Validator library to validate user input and ensure that it meets specific criteria. It checks for data type, length, and any other specified requirements before allowing the input to be processed further.
purpose: In software development, user input must be carefully validated to prevent errors and ensure data integrity. This function allows developers to easily implement validation in their code, reducing the risk of bugs or security vulnerabilities caused by invalid input. It also helps to improve the overall user experience by providing clear and concise error messages when input does not meet the required criteria. use Validator;

function: Session
docstring: This function represents a session in software development, which is a temporary and interactive connection between a user and a system or application. It allows the user to perform a series of actions or tasks within a specific time frame and maintains the state of the user's interactions with the system.
purpose: The Session function is essential in software development as it enables the creation and management of user sessions, which are necessary for tracking and maintaining user data and activities. It also allows for personalized and interactive experiences for users, making applications more user-friendly and efficient. Additionally, sessions help with security by implementing measures such as session expiration and authentication.use Session;

Function: index
Docstring: Displays a listing of the resource based on the filters provided by the user.
Purpose: This functionality allows the user to view and filter through a list of states in the system. It is essential for managing and organizing states, and provides a user-friendly interface for easier navigation and searching. 
class StateController extends Controller
{
        /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $filters = [
            'state_title' => $request->query('state_title'),
            'status' => $request->query('status'),
        ];

        // fetching user lists
        $states = State::sortable()->where('states.is_deleted', '=', 0);
        
        // checks if search filters are set
        if($filters['state_title'] != '') {
            $states->where('states.title', 'like', '%'.$filters['state_title'].'%');
        }
        if($filters['status'] != '') {
            $states->where('states.status', '=', $filters['status']);
        }
        $states = $states->paginate(20);
        
        return view('admin::state.index', ['states'=>$states, 'filters' => $filters]);
    }


    /**
     * Display Add state template
     * @return Renderable
     */
    public function add()
    {
        return view('admin::state.add');
    }

    /**
     * Adds state record
     * @return Renderable
     */
    public function create_state(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:states|max:255',
        ]);
        
        if ($validator->passes()) {
            // create user record
            State::create([
                'name' => $request->input('name'),
                'status' => $request->input('status'),
            ]);
        } else {
            $errors=$validator->errors();
            return redirect()->route('admin::state_add')->with('errors',$errors);
        }

        return redirect()->intended('admin/states')->withSuccess('State created successfully');
    }

    /**
     * Display Edit state template
     * @return Renderable
     */
    public function edit($id)
    {
        // fetching user details
        $state_data = State::find($id);
                    
        return view('admin::state.edit', ['state_data' => $state_data]);
    }


    /**
     * Updates state record
     * @return Renderable
     */
    public function update_state(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->passes()) {
            // fetching the user data wrt id
            $model= State::find($id);

            // creating user data updation array
            $model->name = $request->input('name');
            $model->status = $request->input('status');

            // update user record
            $model->save();

            return redirect()->intended('admin/states')->withSuccess('State updated successfully');
        } else {
            $errors=$validator->errors();
            return redirect()->route('admin::state_edit', ['id' => $id])->with('errors',$errors);
        }
    }


    /**
     * Soft delete state record
     * @return Renderable
     */
    public function state_delete(Request $request, $id)
    {
        // fetching the user data wrt id
        $model= State::find($id);

        // creating user data updation object
        $model->is_deleted = 1;
        
        // update user record
        $model->save();

        return redirect()->intended('admin/states')->withSuccess('State deleted successfully');
    }
}

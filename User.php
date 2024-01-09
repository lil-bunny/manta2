
function: php_open_tag
docstring: This function is used to open a PHP code block.
purpose: In software development, PHP is a popular programming language used for web development. This function allows developers to easily open a PHP code block, making it easier to work with PHP code within a larger HTML document. It helps to organize and structure code, making it more readable and maintainable. <?php

Function: App\Models;
Docstring: This class serves as the namespace for all the models in the application. It is used to group and organize all the models in one place and avoid naming conflicts. 
Purpose: Namespaces are an important concept in software development as they help to organize code and make it more maintainable. This functionality allows us to easily access and use models in our application without having to worry about naming collisions. It also helps to improve code readability and structure. namespace App\Models;

function: MustVerifyEmail
docstring: This interface defines the contract that must be implemented by user models that need to verify their email address. It contains methods for generating and sending email verification notifications, as well as for checking the verification status of the email address.
purpose: In software development, email verification is a crucial step for ensuring the validity and security of user accounts. This functionality allows for seamless integration of email verification into user authentication processes, ensuring that only verified users have access to the system. By implementing this interface, developers can easily add email verification capabilities to their user models without having to write the same code repeatedly. This promotes code reusability and maintainability, making the development process more efficient. Additionally, this functionality helps to enhance the overall security of the system by verifying the email address of users, reducing the risk of fraudulent or unauthorized access.use Illuminate\Contracts\Auth\MustVerifyEmail;

Function: HasFactory
Docstring: This function allows the Eloquent model to use factories for generating test data. It is used to define the model's factory by calling the factory() method in the model's factory definition. 
Purpose: In software development, testing is an essential part of the development process. This functionality makes it easier to generate test data for Eloquent models, saving time and effort for developers. It allows for more efficient and accurate testing of models, ensuring their functionality and performance. use Illuminate\Database\Eloquent\Factories\HasFactory;
 function:authenticatable
  docstring:This function is used to create a new user instance that can be authenticated in the application.
  purpose:In software development, authentication plays a crucial role in ensuring the security and integrity of user data. This function allows developers to easily create a user model that can be used for user authentication within the application. It provides a standardized way of managing user credentials and permissions, making it easier for developers to implement authentication features in their software. use Illuminate\Foundation\Auth\User as Authenticatable;

function: useNotifiableTrait
docstring: This trait provides the functionality of being notifiable, allowing the class to send notifications to different channels.
purpose: In software development, notifications play a crucial role in keeping users informed and engaged. The useNotifiableTrait allows a class to easily implement the necessary methods and properties to be able to send notifications through various channels such as email, SMS, and push notifications. This improves the user experience and helps in keeping them updated with important information. use Illuminate\Notifications\Notifiable;

function: useSanctum
docstring: This function enables the use of Laravel Sanctum's API token authentication for a specific model.
purpose: In software development, API token authentication is a common security measure used to authenticate API requests. This function allows developers to easily implement this feature in their Laravel application by utilizing the functionality provided by the Sanctum package. This helps to ensure the security and protection of the application's API routes and resources.use Laravel\Sanctum\HasApiTokens;

function:Sortable
docstring: This function allows for sorting of data columns in a software application. It provides a convenient and efficient way to organize and display data in a user-friendly manner. It utilizes the Sortable interface to implement customizable sorting options for different types of data. 
purpose: Sorting is a common and essential task in software development, especially for applications that deal with large amounts of data. The Sortable function provides a reusable and flexible solution for sorting data columns, making it easier for developers to implement sorting functionality in their applications. This helps to improve the user experience and overall efficiency of the software. use Kyslik\ColumnSortable\Sortable;

Function: role()
Docstring: This function retrieves the role associated with the user.
Purpose: In software development, this functionality is essential for accessing and managing user roles, which are key components of user permissions and access levels within an application. By retrieving the role, this function enables developers to implement role-based authorization and control access to specific features or information based on a user's role. This helps to ensure proper data security and user management within the application.class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;
    //protected $guard = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'google_id',
        'mobile',
        'image',
        'password',
        'role_id',
        'status',
        'created_by',
    ];


    public $sortable = [
        'id',
        'full_name',
        'email',
        'role_id',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }
}

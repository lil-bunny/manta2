 function: php
  docstring: This function is used to indicate the start of a PHP code block. It is a reserved keyword in PHP and is required for the interpreter to recognize and execute PHP code.
  purpose: The purpose of this function is to serve as the opening tag for PHP code, allowing developers to write and execute PHP code within a HTML document. It is an essential element in software development using PHP as it allows for dynamic and interactive web pages.<?php

Function: App\Models;
Docstring: This module contains all the models used in the app.
Purpose: The purpose of this functionality is to organize and store all the models used in the app in one central location. This makes it easier for developers to access and use the models in different parts of the app without having to import them separately. It also helps to maintain consistency and avoid duplication of code. namespace App\Models;

Function: MustVerifyEmail
Docstring: This function is used to indicate that a user must verify their email address before they can fully use the application.
Purpose: In software development, email verification is a common security measure to ensure that the user of the application is the rightful owner of the provided email address. It also helps to prevent fake or spam accounts from being created. This function serves as a reminder for developers to implement the necessary steps for email verification in their application.use Illuminate\Contracts\Auth\MustVerifyEmail;

function: HasFactory
docstring: This trait provides a factory method for creating model instances.
purpose: The HasFactory trait is used in Eloquent models to easily generate new instances of the model class. It allows developers to quickly create dummy data or seed a database with model instances for testing or development purposes. This functionality helps to streamline the process of creating and managing model instances, making software development more efficient and less time-consuming.use Illuminate\Database\Eloquent\Factories\HasFactory;

function: User
docstring: This class represents a user in the software system. It extends the Authenticatable class from the Illuminate Foundation package. It contains methods and properties for managing user authentication and authorization within the system.
purpose: The User class is a core component of the software system, responsible for managing user accounts and permissions. It provides a standardized way of handling user authentication and authorization, making it easier for developers to implement these features in their applications. Additionally, by extending the Authenticatable class, it inherits useful methods and properties for handling user credentials and sessions. use Illuminate\Foundation\Auth\User as Authenticatable;

function: useNotifiable
docstring: This function allows the class to use the Notifiable trait, which provides a convenient way to send notifications to different channels like email, SMS, and database. It also provides methods to manage the notifications, such as marking them as read or unread.
purpose: The Notifiable trait provides a reusable and flexible way to send notifications in software development, reducing the need for writing custom notification logic for each channel. It improves the user experience by allowing notifications to be sent through various channels and providing methods to easily manage them. This functionality promotes code organization and maintainability in applications.use Illuminate\Notifications\Notifiable;

function: hasApiTokens
docstring: This function enables the usage of API tokens for user authentication and authorization in the Laravel framework.
purpose: In software development, API tokens are used for secure communication between different systems. This functionality allows users to generate and manage API tokens for their account, which can then be used to access and interact with the Laravel application's API endpoints. This helps to improve security and control access to the API, making it a crucial feature for developing robust and secure web applications.use Laravel\Sanctum\HasApiTokens;

function: sortable
docstring: This function allows for sorting of data based on specified criteria. It utilizes the Sortable trait from the Kyslik\ColumnSortable package.
purpose: Sorting data is a common task in software development, especially when dealing with large datasets. This function provides a convenient and efficient way to sort data based on specific criteria, allowing for easier organization and analysis of data. By implementing the Sortable trait, this functionality can be easily integrated into different projects, saving developers time and effort in implementing sorting algorithms. use Kyslik\ColumnSortable\Sortable;

Function: Area

Docstring: This function is used to define a new area in the system. It takes in various attributes such as title, location, income group, media formats, etc. and creates a new area with these details. It also allows for sorting and filtering of areas based on different criteria.

Purpose: The purpose of this functionality is to provide a way for users to add and manage different advertising areas in the system. This is essential in planning and executing ad campaigns, as it allows for targeting specific locations and demographics. The sorting and filtering capabilities also make it easier to find and select the most suitable areas for a particular campaign. class Area extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;
    //protected $guard = 'user';

    // Cast attributes JSON to array
    protected $casts = [
        'gridTrends' => 'array'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'site_location',
        'priority',
        'income_group',
        'road_name',
        'pin_code',
        'lat',
        'lng',
        'state_id',
        'city_id',
        'city_tag',
        'face_traffic_from',
        'place_type',
        'media_formats',
        'orientation',
        'media_tags',
        'height',
        'width',
        'illumination',
        'ad_spot_per_second',
        'total_ad_spot_perday',
        'total_advertiser',
        'display_charge_pm',
        'production_cost',
        'installation_cost',
        'media_partner_name',
        'media_partner_email',
        'area_pic1',
        'area_pic2',
        'area_video',
        'nearby_places',
        'gridTrends',
        'site_count',
        'error_response',
        'status',
        'created_by',
        'updated_at',
        'created_at',
    ];


    public $sortable = [
        'id',
        'title',
        'state_id',
        'city_id',
        'site_location',
        'created_at'
    ];

    public function state() {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }

    // public function user() {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function site_marit_values() {
        return $this->belongsToMany(SiteMeritValue::class, 'area_site_merit_value')->setEagerLoads([]);
    }
}

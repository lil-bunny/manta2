
function: php
docstring: This function is used to indicate the beginning of a PHP code block.
purpose: The purpose of this function is to identify the start of a PHP code block, allowing developers to switch between PHP and HTML within a single file and to create dynamic and interactive web pages. <?php
 function: thirdPartyServices
docstring: This function is responsible for storing the credentials for third party services such as Mailgun, Postmark, AWS and more. It provides a centralized location for this type of information, making it easier for packages to locate and access the necessary service credentials.
purpose: The purpose of this functionality is to streamline the process of accessing and utilizing third party services in software development, making it more convenient and efficient for developers to integrate these services into their applications. This helps to reduce the amount of time and effort required to set up and manage these services, allowing developers to focus on other aspects of their software development. return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'), 
        'client_secret' => env('GOOGLE_CLIENT_SECRET'), 
        'redirect' => env('APP_URL').'/google/callback'
    ],

];


function: render_template
docstring: Renders an HTML template with the given data and returns the generated HTML as a string.
purpose: This function is used in web development to dynamically generate HTML pages by combining template files with data from the application. It helps in creating a consistent layout and structure for web pages while also allowing for flexibility in displaying different data. This functionality is essential for creating user-friendly and visually appealing web applications.<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Admin</title>

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/admin.css') }}"> --}}

    </head>
    <body>
        @yield('content')

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/admin.js') }}"></script> --}}
    </body>
</html>


function: admin_dashboard_view
docstring: This function generates the HTML code for the admin dashboard view, which includes the top bar, sidebar, and content section.
purpose: This functionality allows for the creation of a user-friendly and visually appealing admin dashboard interface for managing and accessing various features and data within a software system.<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

        <link rel="apple-touch-icon" href="{{ asset('images/favicon/apple-touch-icon-152x152.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon/favicon-32x32.png') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- BEGIN: VENDOR CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('vendors/vendors.min.css') }}">
        <!-- END: VENDOR CSS-->
        <!-- BEGIN: Page Level CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-modern-menu-template/materialize.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/vertical-modern-menu-template/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/login.css') }}">
        <!-- END: Page Level CSS-->
        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom/custom.css') }}">
        <!-- END: Custom CSS-->
    </head>
    <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
        <!-- Topbar -->
        @include('admin::common.admin_header')
        <!-- End of Topbar -->

        <!-- Sidebar -->
        @include('admin::common.admin_sidebar')
        <!-- End of Sidebar -->


        @yield('content')

        <!-- Footer -->
        @include('admin::common.admin_footer')
        <!-- End of Footer -->

        <!-- BEGIN VENDOR JS-->
        <script src="{{ asset('js/vendors.min.js') }}"></script>
        <!-- BEGIN VENDOR JS-->
        <!-- BEGIN PAGE VENDOR JS-->
        <!-- END PAGE VENDOR JS-->
        <!-- BEGIN THEME  JS-->
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/custom/custom-script.js') }}"></script>
        <!-- END THEME  JS-->
        <!-- BEGIN PAGE LEVEL JS-->
        <!-- END PAGE LEVEL JS-->
    </body>
</html>

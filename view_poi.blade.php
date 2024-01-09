 function: admin_area_details
  docstring: This function generates the HTML code for the page that displays the details of a specific area's POI (Point of Interest). It uses data from the database to populate the fields with the appropriate values and displays them in a read-only format. It also includes a button to publish the changes made to the POI.
  purpose: This functionality helps in managing and displaying the details of a specific area's POI. It allows the user to view the current information and make necessary changes before publishing them. This is useful for maintaining accurate and up-to-date information about the POIs in a specific area, which is crucial for effective decision making and planning. @extends('admin::layouts.admin_form')

@section('content')

<!-- BEGIN: Page Main-->

<div id="main">
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>POI</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Area POI Details</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <!-- Admin Users Edit start -->
                <div class="section users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="divider mb-3"></div>
                            <div class="row">
                                <div class="col s12" id="account">    
                                    <!-- Location Details Starts Here -->    
                                    <div class="row">
                                        <h4>Area POI Details</h4>
                                        @foreach($poi_data as $key => $poi_info)
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12">
                                                        <input id="{{ $key }}" name="{{ $key }}" type="text" class="validate" value="{{ $poi_info['value'] }}" readonly>
                                                        <label>{{ $poi_info['label'] }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- poi form ends -->
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col s12 display-flex justify-content-end mt-3">
                                    <a href="{{route('admin.area')}}" class="btn indigo">Publish</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Page Main-->
@endsection

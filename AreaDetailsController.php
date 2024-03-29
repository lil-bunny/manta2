
Function: area_search
Docstring: This function handles the search functionality for areas. It takes in a request object and retrieves the necessary data, including the areas and their corresponding locations, media formats, and price ranges, from the database. If the request is made via AJAX, it returns the search results in a rendered view and the locations in JSON format. Otherwise, it returns the search results in a view with the necessary data. 
Purpose: The purpose of this functionality is to provide a user-friendly and efficient search experience for users looking for areas. It allows for filtering by location, media format, and price range, and also enables a smooth AJAX-based search without having to reload the page. if ($request->ajax()) {
            $view = view('area-details.area_search_ajax', ['area_lists_ajax' => $data])->render();
            if(count($locations) > 0) {
                return response()->json(['html'=>$view, 'locations_ajax' => json_encode($locations)]);
            } else {
                return response()->json(['html'=>$view, 'locations_ajax' => '']);
            }
            
        }
        
        return view('area-details.area_search', ['locations' => json_encode($locations), 'area_lists' => $data, 'filters' => $filters, 'media_formats' => $media_formats, 'min_price' => $min_price, 'max_price' => $max_price]);
    }

    public function connect_request(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
          'user_id' => 'required',
          'area_id' => 'required'
        ]);
 
        $save = new ConnectRequest;
 
        $save->user_id = $request->user_id;
        $save->area_id = $request->area_id;
 
        $save ->save();

        // adding notification
        $super_admin_users = User::with('role')
        ->whereRelation('role', 'role_id', '=', 'admin')
        ->get();

        
        
        foreach($super_admin_users as $super_admin_user) {
            $notifications = Notification::create([
                'title' => 'A new connect request has been raised by '.$user->full_name,
                'route' => 'admin.connect_request_view',
                'object_id' => $save->id,
                'user_id' => $super_admin_user->id,
                'type' => 'connect_request',
                'is_read' => 0
            ]);
        }
 
        return response()->json(['status'=>'200']);
    }

    public function dload_file(Request $request)
    {
         
        $validatedData = $request->validate([
          'user_id' => 'required',
          'area_id' => 'required'
        ]);
        
        // saving download data
        $save = new Download;
        $save->user_id = $request->user_id;
        $save->area_id = $request->area_id;
        $save ->save();

        // fetching area data
        $area_data = Area::find($request->area_id);
        $file_url = url('public/application_files/area_images').'/'.$area_data->area_pic1;

        return response()->json(['status'=>'200', 'file_name' => $area_data->area_pic1, 'file_url' => $file_url]);
    }
}

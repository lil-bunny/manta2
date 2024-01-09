 function: update
  docstring: This function updates the user data in the database and redirects to the edit user page.
  purpose: This functionality is used to allow users to update their profile information, including name, email, mobile number, profile picture, and password. It ensures that the user data is valid and meets the required criteria before updating the database. This functionality is an essential part of software development as it allows for user management and ensures the accuracy and security of user data.// fetching roles
        $roles = Role::where('is_deleted', '=', 0)
                            ->where('status', '=', 1)->get();

        $id = auth()->user()->id;

        if($validator->passes()) {        
            $model= User::find($id);
            
            // creating user data updation array
            $model->full_name = $request->input('name');
            $model->email = $request->input('email');
            $model->mobile = $request->input('mobile');

            // checking if profile pic is uploaded or not
            if($request->profile_pic) {
                // picture upload
                $fileName = auth()->id() . '_' . time() . '.'. $request->profile_pic->extension();  
                $type = $request->profile_pic->getClientMimeType();
                $size = $request->profile_pic->getSize();
                $request->profile_pic->move(public_path('application_files/user_images'), $fileName);
                $model->image = $fileName;
            }

            // checking if password is set or not
            if($request->input('password')) {
                $model->password = bcrypt($request->input('password'));
            }
            
            $model->save();
            return redirect()->intended('/users/edit/')->with('message',"User updated successfully");
        }
        else{
            // fetching roles
            $roles = Role::where('is_deleted', '=', 0)
                            ->where('status', '=', 1)->get();

            $errors=$validator->errors();
            return redirect()->route('frontend.user_edit')->with('errors',$errors)->with('roles',$roles);
        }
    }
}

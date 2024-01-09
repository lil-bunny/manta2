
Function: role_edit
Docstring: This function edits the details of a specific role and updates it in the database. It first validates the input data and if it is valid, it updates the role record and redirects the user to the roles page with a success message. If there are any errors in the input data, it redirects the user back to the edit page with the error messages displayed.
Purpose: This functionality is used in software development to allow administrators or privileged users to edit the details of a role in the system. It ensures that the role data is accurate and up-to-date, and provides a user-friendly interface for managing roles. This helps in maintaining the overall integrity and security of the system by allowing only authorized users to perform these actions. // update user record
            $model->save();

            return redirect()->intended('admin/roles')->withSuccess('Role updated successfully');
        } else {
            $errors=$validator->errors()->messages();
            return redirect()->route('admin::role_edit', ['id' => $id])->with('errors',$errors);
        }
    }


    /**
     * Soft delete role record
     * @return Renderable
     */
    public function role_delete(Request $request, $id)
    {
        // fetching the user data wrt id
        $model= Role::find($id);

        // creating user data updation object
        $model->is_deleted = 1;
        
        // update user record
        $model->save();

        return redirect()->intended('admin/roles')->withSuccess('Role deleted successfully');
    }
}

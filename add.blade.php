
Function: create_city
Docstring: Creates a new city and adds it to the database.
Purpose: This functionality is used to add new cities to the database, allowing for the management and organization of cities within the software. This can be used in various applications such as a city-based directory or a tourism website. It provides a way for users to add new cities and their corresponding information, making the software more dynamic and user-friendly.<div class="row">
                                                            <div class="col s12 input-field">
                                                                <input id="name" name="name" type="text" class="validate" value=""
                                                                       data-error=".errorTxt2">
                                                                <label for="name">Name</label>
                                                                <small class="errorTxt2"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m6">
                                                        <div class="row">
                                                            <div class="col s12 input-field">
                                                                <select name="status">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                                <label>Status</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m6">
                                                        <div class="row">
                                                            <div class="col m6 s12 input-field">
                                                                <label for="upload_image">Upload Image</label><br>
                                                                <input type="file" class="mt-8" name="city_pic" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 display-flex justify-content-end mt-3">
                                                        <button type="submit" class="btn indigo">Save changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- Admin Users Edit account form ends -->
                                        </div>
                                        
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- Admin Users Edit ends -->
                    </div>
                    <div class="content-overlay"></div>
                </div>
            </div>
        </div>
        <!-- END: Page Main-->
@endsection

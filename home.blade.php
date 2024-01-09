 function: validate
docstring: The validate function checks the input fields of a form and ensures that all required fields are filled out and that the data entered is valid. It also handles the form submission by sending an AJAX request to the server.
purpose: This functionality is used to validate user input and prevent invalid data from being submitted to the server. It helps in maintaining data integrity and providing a better user experience by informing the user of any errors before submitting the form. It is an essential part of form handling in software development.<script type="text/javascript">
        if ($("#contactUsForm").length > 0) {
            $("#contactUsForm").validate({
                rules: {
                    user_id: {
                        required: true,
                        maxlength: 50
                    },
                    area_id: {
                        required: true,
                        maxlength: 50,
                    },  
                },
                messages: {
                    user_id: {
                        required: "Invalid data",
                        maxlength: "Invalid data"
                    },
                    area_id: {
                        required: "Invalid data",
                        maxlength: "Invalid data",
                    },
                },
                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#submit').html('Please Wait...');
                    $("#submit"). attr("disabled", true);
                    $.ajax({
                        url: "{{url('connect-request')}}",
                        type: "POST",
                        data: $('#contactUsForm').serialize(),
                        success: function( response ) {
                            $('#submit').html('Connect request raised successfully');
                        }
                    });
                }
            })
        }

        if ($("#dloadForm").length > 0) {
            $("#dloadForm").validate({
                rules: {
                    user_id: {
                        required: true,
                        maxlength: 50
                    },
                    area_id: {
                        required: true,
                        maxlength: 50,
                    },  
                },
                messages: {
                    user_id: {
                        required: "Invalid data",
                        maxlength: "Invalid data"
                    },
                    area_id: {
                        required: "Invalid data",
                        maxlength: "Invalid data",
                    },
                },
                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#dloadSubmit').html('Please Wait...');
                    $("#dloadSubmit").attr("disabled", true);
                    $.ajax({
                        url: "{{url('dload-file')}}",
                        type: "POST",
                        data: $('#dloadForm').serialize(),
                        success: function(res) {
                            console.log(res.file_name);

                            // changing the submit link
                            $('#dloadSubmit').html('Download Successfull');

                            // downloading the file
                            const link = document.createElement("a");
                            link.download = res.file_name;
                            link.href = res.file_url;
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        }
                    });
                }
            })
        }
        </script>
    </body>
</html>

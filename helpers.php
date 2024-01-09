
function: start_php_tag
docstring: This function is used to insert the starting PHP tag '<?php' in a file.
purpose: In software development, PHP is a popular programming language used for web development. In order to indicate that a file contains PHP code, the starting tag '<?php' must be inserted. This function provides an easy and efficient way to insert the tag in a file, saving developers time and avoiding errors. It is an essential functionality for any PHP development project. <?php

function: calculate_average
docstring: Calculates the average of given numbers
purpose: To provide a reusable and efficient way of finding the average value in software development./**

 * Write code on Method

 *

 * @return response()

 */

Function: obfuscate_email
Docstring: This function takes in an email address and replaces the first half of the email with asterisks to obscure it. It then returns the obfuscated email address. 
Purpose: In software development, it is important to protect sensitive information, such as email addresses, from being easily accessible. This function allows for the obfuscation of email addresses, providing an additional layer of security for user data. This can be useful in applications that handle sensitive information, such as login systems or contact forms. if (! function_exists('obfuscate_email')) {

    function obfuscate_email($email) {
        $em   = explode("@",$email);
        $name = implode('@', array_slice($em, 0, count($em)-1));
        $len  = floor(strlen($name)/2);

        return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
    }

}

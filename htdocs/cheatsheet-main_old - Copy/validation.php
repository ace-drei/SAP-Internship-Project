<?php

define('DB_HOST', 'localhost');

define('DB_USER', 'root');

define('DB_PASS', '');

define('DB_NAME', 'cheatsheetapp');

 

// Establish database connection

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

 

// Check for connection error

if ($conn->connect_error) {

    die('Connection failed: ' . $conn->connect_error);

}

 

// Function to validate username

function validateUsername($username) {

    global $conn;

 

    // Check if username already exists in database

    $sql = "SELECT username FROM profile WHERE username = '$username'";

    $result = $conn->query($sql);

   

    if ($result->num_rows > 0) {

        return "Username already taken";

    }

}

 

// Function to validate password

function validatePassword($password, $confirmPassword)

    {

        // Check if passwords match

        if ($password != $confirmPassword)

        {

            return "Both passwords are not the same";

        }

    }

 

// Function to validate full name

function validateFullName($fullName)

    {

        // Check to make sure only alphabets, spaces, and dots are used

        if (!preg_match("/^[a-zA-Z .]+$/", $fullName))

        {

            return "Full name should only contain alphabets, spaces, and dots.";

        }

    }

 

// Function to validate qualifications

function validateQualifications($qualifications) {

    // Check to make sure only alphabets, spaces, and dots are used

    if (!preg_match("/^[a-zA-Z .]+$/", $qualifications)) {

        return "qualifications should only contain alphabets, spaces, and dots.";

    }

}

 

 

// Function to validate skillSets

function validateSkillSets($skillSets)

{

    // Check to make sure only alphabets, numbers, spaces, dots, commas, and hyphens are used

    if (!preg_match("/^[a-zA-Z0-9 .,-\/]+$/", $skillSets))
{
    return "Skill Sets should only contain alphabets, numbers, spaces, dots, commas, hyphens, and forward slashes.";
}

}

 

// Function to validate email

function validateEmail($email)

{

    // Sanitize the email address to remove any unwanted characters

    $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);

 

    // Validate the sanitized email address

    if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {

        return "Emailis not a valid email address such as demo.test@sap.com.";

    }

 

    // Check if the email address ends with "@sap.com"

    $domain = "@sap.com";

    $length = strlen($domain);

    $email_domain = substr($sanitized_email, -$length);

    if ($email_domain !== $domain) {

        return "Email must end with '@sap.com'";

    }

 

    return ''; // No error

}

 

// Function to validate Work Number

function validateWorkNumber($workNumber)

{

    // Check to make sure phone number is 10 digits long and starts with 0

    if (!preg_match("/^0[0-9]{9}$/", $workNumber))

    {

        return "Work Number should be 10 digits long and start with 0";

    }

}

 

// Function to validate location

function validateLocation($location)

{

    // Remove white spaces and new lines

    $location = trim(preg_replace('/\s+/', ' ', $location));

 

    // Check if the location is not empty

    if (empty($location)) {

        return "Location field is required.";

    }

 

    // Check if the location contains only alphabets, digits, spaces, commas, and periods

    if (!preg_match('/^[a-zA-Z0-9\s\.,]+$/', $location)) {

        return "Location should only contain letters, digits, spaces, commas, and periods.";

    }

 

    // Check if the location is less than or equal to 256 characters

    if (strlen($location) > 256) {

        return "Location should not exceed 256 characters.";

    }

 

    // If all checks pass, return null

    return null;

}

 

// Function to validate team

function validateTeam($team)

{

    // Check to make sure only alphabets, spaces, and dots are used

    if (!preg_match("/^[a-zA-Z .]+$/", $team))

    {

        return "team should only contain alphabets, spaces, and dots.";

    }

}

// Function to validate department

function validateDepartment($department)

{

    // Check to make sure only alphabets, spaces, and dots are used

    if (!preg_match("/^[a-zA-Z .]+$/", $department))

    {

        return "department should only contain alphabets, spaces, and dots.";

    }

}

// Function to validate image

function validateImage($image) {

    // Check if file was uploaded

    if (!isset($image['tmp_name']) || empty($image['tmp_name'])) {

        return "Please select an image to upload";

    }

 

    // Check if file is a valid image

    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {

        return "Only JPG, JPEG, PNG and GIF images are allowed";

    }

 

    // Check if file size is within limit

    $maxFileSize = 500 * 1024 * 1024; // 5MB

    if ($image['size'] > $maxFileSize) {

        echo "<script type='text/javascript'>alert('The uploaded image size exceeds the maximum allowed limit of 5MB');</script>";

        //return "The uploaded image size exceeds the maximum allowed limit of 5MB";

       

    }

 

    // If all checks passed, return null (no error message)

    return null;

 

}

?>
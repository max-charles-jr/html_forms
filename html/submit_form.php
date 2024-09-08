<?php
// Database credentials
$servername = getenv('MYSQL_HOST');
$username = "root";   // Change this if you have a different MySQL username
$password = "my-secret-pw";       // Change this if you have a MySQL password
$dbname = "my_form";  // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$telephone = $_POST['telephone'];
$age = $_POST['age'];

// Check if a user with the same first and last name already exists
$sql_check = "SELECT * FROM users WHERE first_name = '$first_name' AND last_name = '$last_name'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    // User exists, update their address, telephone, or age
    $sql_update = "UPDATE users 
                    SET address = '$address', telephone = '$telephone', age = '$age'
                    WHERE first_name = '$first_name' AND last_name = '$last_name'";

    if ($conn->query($sql_update) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Record updated successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error updating record: ' . $conn->error;
    }
} else {
    // No matching user, insert a new record
    $sql_insert = "INSERT INTO users (first_name, last_name, address, telephone, age)
                    VALUES ('$first_name', '$last_name', '$address', '$telephone', '$age')";

    if ($conn->query($sql_insert) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'New record created successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error inserting record: ' . $conn->error;
    }
}

// Close the connection
$conn->close();

// Return the response as JSON
echo json_encode($response);
exit();
?>

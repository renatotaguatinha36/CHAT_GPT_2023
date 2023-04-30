<?php

// Create a connection to the MySQL database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "testdb";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query for retrieving all users
$sql = "SELECT * FROM users";

// Execute the SQL query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Loop through each row and output the data
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . " - Age: " . $row["age"] . "<br>";
    }
} else {
    echo "No users found";
}

// Close the database connection
$conn->close();

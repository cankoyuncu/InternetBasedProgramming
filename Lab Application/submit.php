<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "students_db"; 


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connect
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Getting and validating form data
$full_name = $_POST["full_name"];
$email = $_POST["email"];
$gender = $_POST["gender"];

// Data validation
$errors = array();

if (empty($full_name)) {
    $errors[] = "Full Name field cannot be left blank.";
}

if (empty($email)) {
    $errors[] = "Email Address alanı boş bırakılamaz.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Enter a valid Email Address.";
}

if (empty($gender)) {
    $errors[] = "Gender field cannot be left blank.";
}

// Error checking and adding to database
if (empty($errors)) {
    // Veritabanına ekleme sorgusu
    $sql = "INSERT INTO students (full_name, email, gender)
            VALUES ('$full_name', '$email', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "The data has been successfully added to the database.";
    } else {
        echo "Data insertion error: " . $conn->error;
    }
} else {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}

// Pulling student information from database
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Checking and listing results
if ($result->num_rows > 0) {
    echo "<h2>Registered Students:</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Gender</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["full_name"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["gender"]."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "There are no registered students yet.";
}

// Closing the connection
$conn->close();

?>

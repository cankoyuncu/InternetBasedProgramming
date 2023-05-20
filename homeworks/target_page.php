<!DOCTYPE html>
<html>
<head>
    <title>Data Page</title>
</head>
<body>
<h1>Data Page</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = $_GET["name"];
    $email = $_GET["email"];

    echo "<p>Name: " . $name . "</p>";
    echo "<p>Email: " . $email . "</p>";
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $age = $_POST["age"];
    $country = $_POST["country"];

    echo "<p>Age: " . $age . "</p>";
    echo "<p>Country: " . $country . "</p>";
}
?>
</body>
</html>

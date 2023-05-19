<?php

$servername = "localhost"; // Sunucu adı
$username = "root"; // MySQL kullanıcı adı
$password = ""; // MySQL şifresi
$dbname = "students_db"; // Veritabanı adı


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
    $errors[] = "Full Name alanı boş bırakılamaz.";
}

if (empty($email)) {
    $errors[] = "Email Address alanı boş bırakılamaz.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Geçerli bir Email Address giriniz.";
}

if (empty($gender)) {
    $errors[] = "Gender alanı boş bırakılamaz.";
}

// Error checking and adding to database
if (empty($errors)) {
    // Veritabanına ekleme sorgusu
    $sql = "INSERT INTO students (full_name, email, gender)
            VALUES ('$full_name', '$email', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Veri başarıyla veritabanına eklendi.";
    } else {
        echo "Veri ekleme hatası: " . $conn->error;
    }
} else {
    // Hata mesajlarını gösterme
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}

// Pulling student information from database
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Checking and listing results
if ($result->num_rows > 0) {
    echo "<h2>Kayıtlı Öğrenciler</h2>";
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
    echo "Henüz kayıtlı öğrenci bulunmamaktadır.";
}

// Closing the connection
$conn->close();

?>

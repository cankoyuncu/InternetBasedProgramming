<?php
// Veritabanı bağlantısı için gerekli bilgileri ayarlayın
$servername = "localhost";
$username = "kullanici_adi";
$password = "sifre";
$dbname = "veritabani_adi";

// Veritabanı bağlantısını oluşturun
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol edin
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Formdan gönderilen verileri alın
$clinic = $_POST['clinic'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];
$name = $_POST['name'];
$email = $_POST['email'];

// Verileri veritabanına kaydetmek için SQL sorgusunu oluşturun
$sql = "INSERT INTO randevular (clinic, appointment_date, appointment_time, name, email) VALUES ('$clinic', '$appointment_date', '$appointment_time', '$name', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Randevu başarıyla kaydedildi.";
} else {
    echo "Randevu kaydedilirken hata oluştu: " . $conn->error;
}

// Veritabanı bağlantısını kapatın
$conn->close();
?>

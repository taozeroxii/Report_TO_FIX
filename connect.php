<?php
// Create connection
$conn = new mysqli('localhost', 'root', '','users');
mysqli_set_charset($conn, "utf8");//แปลงค่าconfig ให้ดึงค่าเป็น utf8 แก้ภาษาไทย ??? เป็น ปกติ 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    //echo "Connected successfully";
?>
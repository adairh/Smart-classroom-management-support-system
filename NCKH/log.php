<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nckh";
 
// tạo connection
$conn = new mysqli($servername, $username, $password, $dbname);
// kiểm connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
$sql = "SELECT no, Hovaten FROM 10a1 WHERE no = 1";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // output dữ liệu trên trang
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["no"]. " - Name: " . $row["Hovaten"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
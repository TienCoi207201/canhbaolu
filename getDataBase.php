<?php
$file = 'database.txt';

// Kiểm tra nếu có dữ liệu từ ESP8266 gửi đến
if (isset($_GET['database'])) {
    $data = $_GET['database'];  // Lấy dữ liệu từ tham số "database"

    // Ghi đè dữ liệu vào file
    file_put_contents($file, $data);

    // Phản hồi lại ESP8266
    echo "Dữ liệu đã được ghi đè!";
} else {
    echo "Không nhận được dữ liệu!";
}
?>

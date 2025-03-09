<?php
$file = 'status.txt';

// Kiểm tra nếu có dữ liệu từ ESP8266 gửi đến
if (isset($_GET['status'])) {
    $data = $_GET['status']; // Lấy dữ liệu từ tham số "database"
    
    // Ghi đè dữ liệu vào file
    file_put_contents($file, $formattedData);
   
} else {
    echo "Không nhận được dữ liệu!";
}
?>

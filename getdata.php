<?php
$file = 'data.txt';

// Kiểm tra nếu có dữ liệu từ ESP8266 gửi đến
if (isset($_GET['data'])) {
    $data = $_GET['data'];  // Lấy dữ liệu từ tham số "data"
    $timestamp = date("Y-m-d H:i:s");

    // Lưu nguyên chuỗi vào file
    $log = "$timestamp - Data: $data\n";
    file_put_contents($file, $log, FILE_APPEND);

    // Phản hồi lại ESP8266
    echo "Dữ liệu đã được lưu!";
} else {
    echo "Không nhận được dữ liệu!";
}
?>

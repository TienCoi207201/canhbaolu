<?php
$file = 'data.txt';

// Kiểm tra nếu có dữ liệu từ ESP8266 gửi đến
if (isset($_GET['data'])) {
    $data = $_GET['data'];  // Lấy dữ liệu từ tham số "data"

    // Ghi đè dữ liệu vào file (không thêm ngày tháng, giờ)
    file_put_contents($file, $data);

} else {
    echo "Không nhận được dữ liệu!";
}
?>

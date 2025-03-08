<?php
while (true) {
    $dataPath = 'data.txt';
    $databasePath = 'database.txt';
    $statusPath = 'status.txt';

    // Kiểm tra xem file có tồn tại không
    if (!file_exists($dataPath) || !file_exists($databasePath)) {
        file_put_contents($statusPath, '0');
        die("Lỗi: Một trong hai file không tồn tại.\n");
    }

    // Đọc nội dung file
    $dataFile = file_get_contents($dataPath);
    $databaseFile = file_get_contents($databasePath);

    // Kiểm tra nếu file rỗng
    if (empty(trim($dataFile)) || empty(trim($databaseFile))) {
        file_put_contents($statusPath, '0');
        die("Lỗi: Một trong hai file rỗng.\n");
    }

    // Chuyển nội dung thành mảng bằng cách tách theo dấu phẩy
    $dataArray = array_map('trim', explode(',', trim($dataFile)));
    $databaseArray = array_map('trim', explode(',', trim($databaseFile)));

    // Kiểm tra số lượng phần tử trong mỗi file
    if (count($dataArray) !== 6 || count($databaseArray) !== 6) {
        file_put_contents($statusPath, '0');
        die("Lỗi: Mỗi file phải chứa đúng 6 dữ liệu, cách nhau bởi dấu phẩy.\n");
    }

    // Kiểm tra điều kiện so sánh với dữ liệu dạng chuỗi
    $conditions = [
        strcmp($dataArray[1], $databaseArray[1]) < 0, // data[1] < database[1]
        strcmp($dataArray[4], $databaseArray[4]) < 0, // data[4] < database[4]
        strcmp($dataArray[0], $databaseArray[0]) > 0, // data[0] > database[0]
        strcmp($dataArray[2], $databaseArray[2]) > 0, // data[2] > database[2]
        strcmp($dataArray[3], $databaseArray[3]) > 0, // data[3] > database[3]
        strcmp($dataArray[5], $databaseArray[5]) > 0  // data[5] > database[5]
    ];

    // Nếu có ít nhất một điều kiện đúng, đặt $status = 1, ngược lại là 0
    $status = in_array(true, $conditions) ? 1 : 0;

    // Kiểm tra lỗi khi ghi file status.txt
    if (file_put_contents($statusPath, (string) $status) === false) {
        die("Lỗi: Không thể ghi vào file status.txt\n");
    }

    // Debug: Hiển thị dữ liệu để kiểm tra
    echo "Data: " . implode(',', $dataArray) . "\n";
    echo "Database: " . implode(',', $databaseArray) . "\n";
    echo "Status ghi vào file: $status\n";

    // Chờ 5 giây trước khi kiểm tra lại
    sleep(5);
}
?>

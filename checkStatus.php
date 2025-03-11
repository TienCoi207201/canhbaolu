<?php
set_time_limit(0);

while (true) {
    // Đọc dữ liệu từ file data.txt và database.txt
    $data = file_get_contents("data.txt");
    $database = file_get_contents("database.txt");

    // Kiểm tra nếu đọc file thất bại
    if ($data === false || $database === false) {
        file_put_contents("status.txt", "Error: Cannot read files");
        exit;
    }

    // Chuyển đổi chuỗi thành mảng số
    $data_values = array_map('floatval', explode(",", trim($data)));
    $database_values = array_map('floatval', explode(",", trim($database)));

    // Kiểm tra dữ liệu có đủ 6 giá trị không
    if (count($data_values) < 6 || count($database_values) < 6) {
        file_put_contents("status.txt", "Error: Invalid data format");
        exit;
    }

    // Kiểm tra dữ liệu cho Trạm 1
    $status1 = 0;
    if ($data_values[0] > $database_values[0] || $data_values[2] > $database_values[2] || $data_values[1] < $database_values[1]) {
        $status1 = 1;
    }

    // Kiểm tra dữ liệu cho Trạm 2
    $status2 = 0;
    if ($data_values[3] > $database_values[3] || $data_values[5] > $database_values[5] || $data_values[4] < $database_values[4]) {
        $status2 = 1;
    }

    // Ghi kết quả vào file status.txt
    file_put_contents("status.txt", "$status1,$status2");
    
    // Chờ 5 giây trước khi chạy lại
    sleep(5);
}

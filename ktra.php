<?php
while (true) {
    // Đọc nội dung của file data.txt và database.txt
    $dataFile = file_get_contents('data.txt');
    $databaseFile = file_get_contents('database.txt');

    // Kiểm tra nếu file rỗng
    if (empty($dataFile) || empty($databaseFile)) {
        file_put_contents('status.txt', '0');
        die('Lỗi: Một trong hai file rỗng.');
    }

    // Chuyển nội dung thành mảng bằng cách tách theo dấu phẩy và ép kiểu số thực
    $dataArray = array_map('floatval', explode(',', trim($dataFile)));
    $databaseArray = array_map('floatval', explode(',', trim($databaseFile)));

    // Kiểm tra số lượng phần tử trong mỗi file
    if (count($dataArray) !== 6 || count($databaseArray) !== 6) {
        file_put_contents('status.txt', '0');
        die('Lỗi: Mỗi file phải chứa đúng 6 dữ liệu, cách nhau bởi dấu phẩy.');
    }

    // Biến kiểm tra điều kiện ghi file

    // Kiểm tra điều kiện (sau khi đã ép kiểu số thực)
    if (($dataArray[1] < $databaseArray[1]) || ($dataArray[4] < $databaseArray[4]) ||
        ($dataArray[0] > $databaseArray[0]) || ($dataArray[2] > $databaseArray[2]) ||
        ($dataArray[3] > $databaseArray[3]) || ($dataArray[5] > $databaseArray[5])) {
        $status = 1;
    }else{
       $status=0;
    }
// Ghi đè dữ liệu vào file status.txt
    file_put_contents('status.txt',$status);
    sleep(5);
}

   
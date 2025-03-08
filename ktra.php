<?php
while (true) {
    // Đọc nội dung của file data.txt và database.txt
    $dataFile = file_get_contents('data.txt');
    $databaseFile = file_get_contents('database.txt');

    // Chuyển nội dung thành mảng bằng cách tách theo dấu phẩy
    $dataArray = explode(',', trim($dataFile));
    $databaseArray = explode(',', trim($databaseFile));

    // Kiểm tra số lượng phần tử trong mỗi file
    if (count($dataArray) !== 6 || count($databaseArray) !== 6) {
        file_put_contents('status.txt', '0');
        die('Lỗi: Mỗi file phải chứa đúng 6 dữ liệu, cách nhau bởi dấu phẩy.');
    }

    // Biến kiểm tra điều kiện ghi file
    $status = 0;

    // Kiểm tra điều kiện
    if (($dataArray[1] < $databaseArray[1]) || ($dataArray[4] < $databaseArray[4]) ||
        ($dataArray[0] > $databaseArray[0]) || ($dataArray[2] > $databaseArray[2]) ||
        ($dataArray[3] > $databaseArray[3]) || ($dataArray[5] > $databaseArray[5])) {
        $status = 1;
    }

    // Ghi đè dữ liệu vào file status.txt
    file_put_contents('status.txt', $status);

    // Chờ 5 giây trước khi kiểm tra lại
    sleep(5);
}
?>

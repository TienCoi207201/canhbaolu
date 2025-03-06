const express = require("express");
const fs = require("fs");
const app = express();

app.use(express.urlencoded({ extended: true })); // Xử lý dữ liệu từ form
app.use(express.json()); // Xử lý dữ liệu JSON

// Route GET để nhận dữ liệu từ ESP8266
app.get("/data", (req, res) => {
    let sensorValue = req.query.sensor_value;
    let timestamp = new Date().toISOString();
    let logData = `${timestamp} - Sensor Value: ${sensorValue}\n`;

    fs.appendFile("data.txt", logData, (err) => {
        if (err) {
            console.error("Lỗi ghi file:", err);
            res.status(500).send("Lỗi server");
        } else {
            console.log("Dữ liệu đã được lưu:", logData);
            res.send("Dữ liệu đã được lưu thành công!");
        }
    });
});

// Route POST để nhận dữ liệu từ ESP8266
app.post("/data", (req, res) => {
    let sensorValue = req.body.sensor_value;
    let timestamp = new Date().toISOString();
    let logData = `${timestamp} - Sensor Value: ${sensorValue}\n`;

    fs.appendFile("data.txt", logData, (err) => {
        if (err) {
            console.error("Lỗi ghi file:", err);
            res.status(500).send("Lỗi server");
        } else {
            console.log("Dữ liệu đã được lưu:", logData);
            res.send("Dữ liệu đã được lưu thành công!");
        }
    });
});

// Khởi động server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server đang chạy trên cổng ${PORT}`);
});

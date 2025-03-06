const express = require('express');
const fs = require('fs');
const cors = require('cors');
const path = require('path');

const app = express();

app.use(cors());
app.use(express.json()); 
app.use(express.urlencoded({ extended: true }));

const filePath = path.join('/tmp', 'data.txt'); // Ghi file vào /tmp

app.post('/', (req, res) => {
    const receivedData = req.body.data;
    console.log('Dữ liệu nhận được:', receivedData);

    if (!receivedData) {
        return res.status(400).send('Không có dữ liệu');
    }

    fs.writeFile(filePath, receivedData, (err) => {
        if (err) {
            console.error('Lỗi ghi file:', err);
            return res.status(500).send('Lỗi ghi file');
        }
        console.log('Dữ liệu đã ghi vào:', filePath);
        res.send('Dữ liệu đã được lưu');
    });
});

app.get('/data', (req, res) => {
    fs.readFile(filePath, 'utf8', (err, data) => {
        if (err) {
            console.error('Lỗi đọc file:', err);
            return res.status(500).send('Lỗi đọc file');
        }
        res.send(data);
    });
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server đang chạy tại http://localhost:${PORT}`);
});

const express = require('express');
const fs = require('fs');
const app = express();

app.use(express.json());

app.post('/', (req, res) => {
    const receivedData = req.body.data;
    
    if (!receivedData) {
        return res.status(400).send('No data received');
    }

    fs.writeFile('data.txt', receivedData, (err) => {
        if (err) {
            console.error('Lỗi ghi file:', err);
            return res.status(500).send('Lỗi ghi file');
        }
        console.log('Dữ liệu đã được ghi vào data.txt:', receivedData);
        res.send('Dữ liệu đã được lưu');
    });
});

const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server đang chạy tại http://localhost:${PORT}`);
});

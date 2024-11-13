<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>QR Code Scanner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f9f9f9;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        #reader {
            width: 500px;
            height: 400px;
            border: 2px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        #result {
            margin-top: 20px;
            font-size: 18px;
            color: #28a745;
        }

        .container {
            text-align: center;
            padding: 20px;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
    </head>
<body>
    <div class="container">
        <h1>Scan Barcode</h1>
        <div id="reader"></div>
        <div id="result">Hasil pemindaian akan muncul di sini.</div>
    </div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
    function onScanSuccess(decodedText, decodedResult) {
    console.log(`Code matched = ${decodedText}`, decodedResult);
    alert(`QR Code berhasil dipindai: ${decodedText}`);
    
    fetch('/scan-barcode', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ barcode: decodedText })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Kehadiran berhasil diperbarui");
        } else {
            alert("Gagal memperbarui kehadiran: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Terjadi kesalahan pada sistem. Silakan coba lagi.");
    });

    html5QrcodeScanner.clear();
}

function onScanFailure(error) {
    console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", 
    { 
        fps: 10, 
        qrbox: { width: 300, height: 300 }, 
        aspectRatio: 1.0 
    },
    false
);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    </script>
    
    </body>
</html>
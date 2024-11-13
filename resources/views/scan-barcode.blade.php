<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <title>QR Code Scanner</title>
    </head>
<body>
    <h1>Scan Barcode</h1>
    <div id="reader" style="width:500px;"></div>
    <div id="result"></div>

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
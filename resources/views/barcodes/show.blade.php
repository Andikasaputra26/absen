<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scan Barcode</title>
    <script src="https://cdn.jsdelivr.net/npm/jsqrscanner@1.0.0/dist/jsQRScanner.min.js"></script>
</head>
<body>
    <h1>Scan Barcode / QR Code</h1>

    <!-- Tempat untuk menampilkan live scanner -->
    <div id="scanner-container" style="width: 100%; height: 400px;">
        <canvas id="scanner-canvas" style="width: 100%; height: 100%;"></canvas>
    </div>

    <h3>Or, Scan this QR Code to mark attendance:</h3>
    <div>{!! $barcode !!}</div>

    <script>
        // Inisialisasi pemindai QR dengan JsQRScanner
        document.addEventListener("DOMContentLoaded", () => {
            // Pastikan elemen canvas ada di halaman
            const canvas = document.getElementById("scanner-canvas");

            // Memastikan JsQRScanner berjalan
            const qrScanner = new JsQRScanner(canvas, (decodedText) => {
                // Menampilkan hasil pemindaian QR/Barcode
                console.log("Decoded barcode: " + decodedText);
                alert("Decoded barcode: " + decodedText);

                // Kirim hasil scan ke server untuk validasi
                fetch('/validate-barcode', {
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
                        alert('Siswa ditemukan: ' + data.student.name);
                    } else {
                        alert('Siswa tidak ditemukan!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirimkan data!');
                });
            });

            // Mulai pemindaian
            qrScanner.startScanning();
        });
    </script>
</body>
</html>

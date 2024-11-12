<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scan Barcode</title>
    <script src="https://cdn.jsdelivr.net/npm/quagga@0.12.1/dist/quagga.min.js"></script>
</head>
<body>
    <h1>Scan Barcode</h1>

    <!-- Tempat untuk menampilkan hasil pemindaian -->
    <div id="scanner-container" style="width: 100%; height: 300px;"></div>

    <script>
        // Inisialisasi Quagga untuk memindai barcode
        document.addEventListener("DOMContentLoaded", function() {
            Quagga.init({
                inputStream: {
                    type: "LiveStream",
                    target: document.querySelector("#scanner-container"),
                    constraints: {
                        facingMode: "environment" // Menggunakan kamera belakang (untuk pemindaian barcode)
                    }
                },
                decoder: {
                    readers: ["code_128_reader", "ean_reader", "ean_13_reader", "upc_reader"] // Jenis barcode yang didukung
                }
            }, function(err) {
                if (err) {
                    console.log("Quagga initialization failed: ", err);
                    return;
                }
                console.log("Quagga initialized successfully!");
                Quagga.start();
            });

            // Event listener untuk hasil pemindaian
            Quagga.onDetected(function(result) {
                const barcode = result.codeResult.code;
                console.log("Detected Barcode: ", barcode);

                // Kirim hasil barcode ke server untuk validasi
                fetch('/validate-barcode', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ barcode: barcode })
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
                });
            });
        });
    </script>
</body>
</html>

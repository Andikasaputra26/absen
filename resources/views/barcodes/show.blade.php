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
    {{-- <div id="scanner-container" style="width: 100%; height: 200px;">
        <canvas id="scanner-canvas" style="width: 100%; height: 100%;"></canvas>
    </div> --}}

    <div>{!! $barcode !!}</div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const canvas = document.getElementById("scanner-canvas");
            const qrScanner = new JsQRScanner(canvas, (decodedText) => {
    console.log("Decoded barcode: " + decodedText);
    alert("Decoded barcode: " + decodedText);

    // Debugging: Log the fetch payload
    const payload = { barcode: decodedText };
    console.log("Payload:", payload);

    fetch('/validate-barcode', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(data => {
        console.log("API Response:", data);  // Log API response
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


            // Pastikan mengakses video stream dari kamera
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
                .then((stream) => {
                    const video = document.createElement("video");
                    video.srcObject = stream;
                    video.setAttribute("autoplay", true);
                    video.setAttribute("playsinline", true);
                    video.style.width = '100%';
                    video.style.height = '100%';
                    document.getElementById("scanner-container").appendChild(video);

                    // Start scanning when video is ready
                    video.onplaying = () => {
                        qrScanner.startScanning();
                    };
                })
                .catch((err) => {
                    console.error("Error accessing camera: " + err);
                    alert("Tidak dapat mengakses kamera.");
                });
        });
    </script>
</body>
</html>

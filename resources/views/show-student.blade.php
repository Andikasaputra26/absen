<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa</title>
</head>
<body>
    <h1>Detail Siswa</h1>

    <p><strong>Nama:</strong> {{ $student->name }}</p>
    <p><strong>Barcode:</strong> {{ $student->barcode }}</p>

    @if ($attendance)
        <p><strong>Status Kehadiran:</strong> Hadir</p>
        <p><strong>Waktu Kehadiran:</strong> {{ $attendance->attended_at }}</p>
    @else
        <p><strong>Status Kehadiran:</strong> Belum hadir</p>
    @endif

    <a href="/scan-barcode">Kembali ke Pemindai</a>
</body>
</html>

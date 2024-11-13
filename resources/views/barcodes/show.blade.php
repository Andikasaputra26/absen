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
    <div>{!! $barcode !!}</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Nilai Terbaru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #f1f1f1;
            padding: 10px 0;
        }

        .header h3 {
            margin-top: 5px;
            font-weight: bold;
            text-align: center;
        }

        .content h1 {
            font-size: 24px;
            color: #333333;
            margin-top: 0;
        }

        .content p {
            font-size: 16px;
            color: #555555;
        }

        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-primary {
            color: #004085;
            background-color: #cce5ff;
            border-color: #b8daff;
        }

        .footer {
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h3>Pondok Pesantren AL-Huda</h3>
        </div>
        <div class="content">
            <h1>Halo, {{ $waliSantri->nama_wali_santri }}</h1>
            <p>Nilai terbaru untuk {{ $nama_santri }} sudah tersedia.</p>
            <div class="alert alert-primary" role="alert">
                Silahkan kunjungi website <a href="http://al-huda.com/nilai">{{ url('/nilai') }}</a> untuk melihat detail nilai.
            </div>
            <p>Terima kasih atas perhatiannya.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Pondok Pesantren Al-Huda. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>

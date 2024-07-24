<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Tagihan Baru</title>
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

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td {
            text-align: center;
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
            <h1>Halo, {{ $tagihans[0]->santri->nama_santri }}</h1>
            <p>Anda telah menerima tagihan baru dengan detail sebagai berikut:</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalTagihan = 0; @endphp
                    @foreach ($tagihans as $tagihan)
                        @php $totalTagihan += $tagihan->jumlah_pembayaran; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $tagihan->jenis_pembayaran)) }}</td>
                            <td>Rp{{ number_format($tagihan->jumlah_pembayaran, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="alert alert-primary" role="alert">
                Total tagihan anda senilai <b>Rp{{ number_format($totalTagihan, 0, ',', '.') }}</b>, silahkan melakukan pembayaran di
                <b>Kantor Tata Usaha Pondok Pesantren AL HUDA</b>.
            </div>
            <p>Informasi lebih lanjut, kunjungi website <a href="http://al-huda.com">al-huda.com</a>.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Pondok Pesantren Al-Huda. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
    
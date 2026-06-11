<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Export</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .card-body {
            padding: 10px;
        }

        .card-body .card-title {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid gray;
        }

        .card-body .card-title h6 {
            font-size: 24px;
            font-weight: normal;
        }

        .card-body .card-title p {
            font-size: 16px;
            font-weight: normal;
        }

        .card-body .content .customer thead tr th,
        .card-body .content .customer thead tr td {
            padding: 6px;
            text-align: start;
        }

        .card-body .detail h6 {
            font-size: 18px;
            font-weight: normal;
            text-align: center;
            margin: 10px 0;
        }

        .card-body .detail .detail-pesanan {
            width: 100%;
        }

        .card-body .detail .detail-pesanan thead tr th,
        .card-body .detail .detail-pesanan tbody tr td {
            text-align: center;
            padding: 4px;
        }

        .transaksi {
            margin-top: 20px;
            padding: 10px;
            border-top: 1px solid gray;
        }

        .transaksi h6 {
            font-size: 18px;
            font-weight: normal;
        }

        .transaksi p {
            font-size: 16px;
        }
    </style>

</head>

<body>

    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h6>{{ $kantor->nama }}</h6>
                <p>{{ $kantor->alamat }}</p>
            </div>

            <div class="content">
                <table class="customer">
                    <thead>
                        <tr>
                            <th>Nama Pemesan</th>
                            <td>{{ $data->profile->user->nama }}</td>
                        </tr>
                        <tr>
                            <th>No. Telp</th>
                            <td>{{ $data->profile->no_telp }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Pemesan</th>
                            <td>{{ $data->profile->alamat }}</td>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="detail">
                <h6>Detail Pesanan</h6>
                <table class="detail-pesanan">
                    <thead>
                        <tr>
                            <th>Mobil</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Harga Pesanan</th>
                            <th>Hari</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ $data->mobil->nama_mobil }}
                            </td>
                            <td>
                                {{ $data->tanggal_pemesanan }}
                            </td>
                            <td>
                                {{ $data->tanggal_pengembalian }}
                            </td>
                            <td>
                                Rp. {{ number_format($data->total_harga, 0, ',', '.') }}
                            </td>
                            <td>
                                {{ $data->jumlah_hari }} Hari
                            </td>
                            <td>
                                Rp. {{ number_format($data->total_bayar, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="transaksi">
                <h6>Status Pembayaran</h6>
                <p>{{ $data->status_bayar }}</p>
            </div>

        </div>
    </div>

</body>

</html>

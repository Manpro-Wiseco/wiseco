<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Detail Jurnal Pesanan Pembelian</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 70vw;
            height: 100vh;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
            font-size: 1.2rem;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            padding: 5px;
            text-align: center;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <h1>Detail Pesanan Pembelian</h1>
        <div id="company" class="clearfix">
        </div>
        <div id="project">
            <div><span>DATE</span>
                {{ $tanggal }}
            </div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">Pelanggan</th>
                    <th class="desc">Tanggal</th>
                    <th>No. Pesanan</th>
                    <th>Jumlah Barang</th>
                    <th>Diskon</th>
                    <th>Lainnya</th>
                    <th>Potongan</th>
                    <th>Pajak</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $pesanan)
                    <tr>
                        <td rowspan="">{{ $pesanan->dataContact->name }}</td>
                        <td rowspan="">{{ $pesanan->created_at->format('Y-m-d') }}</td>
                        <td rowspan="">{{ $pesanan->no_pesanan }}</td>
                        <td rowspan="">{{ $pesanan->item_count }}</td>
                        <td rowspan="">{{ $pesanan->discount . '%' }}</td>
                        <td rowspan="">{{ 'Rp ' . number_format($pesanan->other_cost, 2, ',', '.') }}</td>
                        <td rowspan="">{{ 'Rp ' . number_format($pesanan->potongan, 2, ',', '.') }}</td>
                        <td rowspan="">{{ 'Rp ' . number_format($pesanan->pajak, 2, ',', '.') }}</td>
                        <td>
                            {{ 'Rp ' . number_format($pesanan->total, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>

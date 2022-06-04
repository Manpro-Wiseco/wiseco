<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Detail Jurnal Pemasukan</title>
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
        <h1>Detail Jurnal Pemasukan</h1>
        <div id="company" class="clearfix">
        </div>
        <div id="project">
            <div><span>DATE</span>
                {{ (($data_request['tanggal'] === 'custom' ? $data_request['dari_tanggal'] . ' - ' . $data_request['hingga_tanggal'] : $data_request['tanggal'] === 'year') ? \Carbon\Carbon::now()->format('Y') : $data_request['tanggal'] === 'month') ? \Carbon\Carbon::now()->format('F') : \Carbon\Carbon::now()->format('Y-m-d') }}
            </div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">Tanggal</th>
                    <th class="desc">Deskripsi</th>
                    <th>Detail</th>
                    <th>Total</th>
                    <th>Via</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $income)
                    <tr>
                        <td rowspan="">{{ $income->created_at->format('Y-m-d') }}</td>
                        <td rowspan="">{{ $income->description }}</td>
                        <td>
                            <!-- nested row -->
                            <table>
                                @foreach ($income->dataAccounts as $dataAccount)
                                    <tr>
                                        <td>{{ $dataAccount->name }}</td>
                                        <td>{{ 'Rp ' . number_format($dataAccount->pivot->amount, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                        <td>
                            {{ 'Rp ' . number_format($income->total, 2, ',', '.') }}
                        </td>
                        <td>{{ $income->toAccount->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>

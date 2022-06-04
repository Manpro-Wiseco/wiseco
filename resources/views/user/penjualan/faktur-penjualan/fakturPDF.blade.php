<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Faktur Penjualan -  {{ $data_details->no_penjualan }}</title>
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
            width: 90vh;  
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
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
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
        }

        #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
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
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;        
        font-weight: normal;
        }

        table .service,
        table .desc {
        text-align: left;
        }

        table td {
        padding: 20px;
        text-align: right;
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
        border-top: 1px solid #5D6975;;
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
      <h1>{{ $data['name_apps'] }} - Faktur Penjualan - {{ $data_details->no_penjualan }}</h1>
      <div id="company" class="clearfix">
        {{-- <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div><a href="mailto:</a></div> --}}
      </div>
      <div id="project">
        <div><span>CLIENT</span> {{ $data_details->pesanan->pelanggan->name }}</div>
        <div><span>TYPE</span> {{ $data_details->pesanan->pelanggan->business_type }}</div>
        <div><span>ADDRESS</span> {{ $data_details->pesanan->pelanggan->address }}</div>
        <div><span>PHONE</span> {{ $data_details->pesanan->pelanggan->phone }}</div>
        <div><span>EMAIL</span> <a href="mailto:{{ $data_details->pesanan->pelanggan->email }}">{{ $data_details->pesanan->pelanggan->email }}</a></div>
        <div><span>DATE</span> {{ date_format($data_details->created_at,"d/m/Y") }}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">PRODUCT</th>
            <th class="desc">DESCRIPTION</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($data_details->pesanan->item as $item)
          <tr>
            <td class="service">{{ $item->item->nameItem }}</td>
            <td class="desc">{{ $item->item->descriptionItem }}</td>
            <td class="unit">{{ $item->harga_barang }}</td>
            <td class="qty">{{ $item->jumlah_barang }}</td>
            <td class="total">Rp.{{ $item->subtotal }}</td>
          </tr>
        @endforeach
          <tr>
            <td colspan="4">DISCOUNT ({{ $data_details->pesanan->discount }}%)</td>
            <td class="total">Rp. {{ $data_details->pesanan->potongan }}</td>
          </tr>
          <tr>
            <td colspan="4">OTHER COST</td>
            <td class="total">Rp. {{ $data_details->pesanan->other_cost }}</td>
          </tr>
          <tr>
            <td colspan="4">TAX</td>
            <td class="total">Rp. {{ $data_details->pesanan->pajak }}</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">Rp. {{ $data_details->pesanan->nilai }}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>DESCRIPTION:</div>
        <div class="notice">{{ $data_details->deskripsi }}</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>
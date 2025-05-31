<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <table style="border-collapse: collapse;">
        <tr>
            <th colspan="6" rowspan="2" align="center" style="vertical-align: middle; border: 1px solid black;"><strong>Data Obat</strong></th>
        </tr>
        <tr></tr>
        <tr style="border: 1px solid black;">
            <th align="center" style="background-color: green; border: 1px solid black;"><b>No</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Nama Obat</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Satuan Obat</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Harga Beli</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Harga Jual</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Stok</b></th>
        </tr>

        @php
        $no = 1;
        @endphp
        @foreach ($obat as $index => $p)
        <tr style="border: 1px solid black;">
            <td align="center" scope="row" style="vertical-align: middle; border: 1px solid black;">{{ $no++ }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->nama_obat }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->satuan }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->harga_beli }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->harga_jual }}</td>
            <td style="vertical-align: middle; border: 1px solid black;">{{ $p->stok }}</td>
        </tr>

        @endforeach
    </table>
</body>

</html>

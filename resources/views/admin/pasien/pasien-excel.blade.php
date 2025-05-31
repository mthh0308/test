<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <table style="border-collapse: collapse;">
        <tr>
            <th colspan="7" rowspan="2" align="center" style="vertical-align: middle; border: 1px solid black;">
                <strong>Data Pasien</strong></th>
        </tr>
        <tr></tr>
        <tr style="border: 1px solid black;">
            <th align="center" style="background-color: green; border: 1px solid black;"><b>No</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>No Rekam Medis</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Nama Pasien</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Tempat Lahir</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Tanggal Lahir</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>Jenis Kelamin</b></th>
            <th align="center" style="background-color: green; border: 1px solid black;"><b>No Hp</b></th>
        </tr>

        @php
            $no = 1;
        @endphp
        @foreach ($pasien as $index => $w)
            <tr style="border: 1px solid black;">
                <td align="center" scope="row" style="vertical-align: middle; border: 1px solid black;">
                    {{ $no++ }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->nocm }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->nama_pasien }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->tempat_lahir }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->tgl_lahir }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->jenis_kelamin }}</td>
                <td style="vertical-align: middle; border: 1px solid black;">{{ $w->no_hp }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>

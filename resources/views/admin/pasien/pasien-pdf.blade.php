<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin: 1cm 1cm 1cm 1cm;
            size: portrait;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 9px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
            font-size: 9px;
        }

        .footer {
            position: fixed;
            left: 1cm;
            bottom: 1cm;
            right: 1cm;
            text-align: right;
            font-size: 9px;
            margin-bottom: 20px; /* Jarak tambahan */
        }

        .signature {
            margin-top: 20px; /* Jarak antara nama penanggung jawab dan garis */
        }

        .staff {
            font-size: 13px; /* Font size untuk staff penanggung jawab */
        }

        .user {
            font-size: 13px; /* Font size untuk pengguna yang login */
        }
    </style>
</head>

<body>

    <h1>Data Pasien</h1>

    <table id="customers">
        <tr>
            <th cscope="row">No</th>
            <th>No Rekam Medis</th>
            <th>Nama Pasien</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>No Hp</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($pasien as $index => $w)
            <tr>
                <td scope="row">{{ $no++ }}</td>
                <td>{{ $w->nocm }}</td>
                <td>{{ $w->nama_pasien }}</td>
                <td>{{ $w->tempat_lahir }}</td>
                <td>{{ $w->tgl_lahir }}</td>
                <td>{{ $w->jenis_kelamin }}</td>
                <td>{{ $w->no_hp }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>

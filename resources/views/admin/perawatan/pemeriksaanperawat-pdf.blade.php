<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin: 1cm 1cm 1cm 1cm;
            size: landscape;
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
            margin-bottom: 20px;
            /* Jarak tambahan */
        }

        .signature {
            margin-top: 20px;
            /* Jarak antara nama penanggung jawab dan garis */
        }

        .staff {
            font-size: 13px;
            /* Font size untuk staff penanggung jawab */
        }

        .user {
            font-size: 13px;
            /* Font size untuk pengguna yang login */
        }
    </style>
</head>

<body>

    <h1>Data Pemeriksaan Pasien</h1>

    <table id="customers">
        <tr>
            <th cscope="row">No</th>
            <th>No RM</th>
            <th>Nama Pasien</th>
            <th>Tempat Lahir</th>
            <th>Tgl Lahir</th>
            <th>JK</th>
            <th>No Hp</th>
            <th>Tgl Periksa</th>
            <th>BB</th>
            <th>TB</th>
            <th>TD</th>
            <th>Suhu</th>
            <th>Nadi</th>
            <th>Pernafasan</th>
            <th>Tgl Periksa Dokter</th>
            <th>Keluhan</th>
            <th>Diagnosa</th>
            <th>Tgl Resep</th>
            <th>Nama Obat</th>
            <th>Jumlah</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($pemeriksaanperawat as $index => $r)
        <tr>
            <td scope="row">{{ $no++ }}</td>
            <td>{{ $r->nocm }}</td>
            <td>{{ $r->nama_pasien }}</td>
            <td>{{ $r->tempat_lahir }}</td>
            <td>{{ $r->tgl_lahir }}</td>
            <td>{{ $r->jenis_kelamin }}</td>
            <td>{{ $r->no_hp }}</td>
            <td>{{ $r->tgl_periksa }}</td>
            <td>{{ $r->beratbadan }}</td>
            <td>{{ $r->tinggibadan }}</td>
            <td>{{ $r->tekanandarah }}</td>
            <td>{{ $r->suhu }}</td>
            <td>{{ $r->nadi }}</td>
            <td>{{ $r->pernafasan }}</td>
            <td>{{ $r->tglperiksadokter }}</td>
            <td>{{ $r->keluhan }}</td>
            <td>{{ $r->diagnosa }}</td>
            <td>{{ $r->tglresep }}</td>
            <td>{{ $r->nama_obat }}</td>
            <td>{{ $r->jumlah }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>

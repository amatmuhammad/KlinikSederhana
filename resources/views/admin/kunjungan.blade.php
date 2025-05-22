<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Laporan Kunjungan Pasien Klinik Sederhana</h2>
    <table width="100%">
        <thead>
            <tr>
                {{-- <th>No</th> --}}
                <th>Nik</th>
                <th>Nama Pasien</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Tanggal Kunjungan</th>
                <th>Poli Tujuan</th>
                <th>Nama Dokter</th>
                <th>Diagnosa</th>
                <th>Tindakan</th>
                <th>Obat Diberikan</th>
                <th>Biaya Total</th>
            </tr>
        </thead>
        <tbody>
            {{-- @if (@isset($data)) --}}
                {{-- @foreach($data as $k) --}}
                    <tr>
                        {{-- <td>{{ $loop->iteration }}</td> --}}
                        <td>{{ $data->pasien->nik ?? '-' }}</td>
                        <td>{{ $data->pasien->nama ?? '-' }}</td>
                        <td>{{ $data->pasien->tanggal_lahir ?? '-' }}</td>
                        <td>{{ $data->pasien->jenis_kelamin ?? '-' }}</td>
                        <td>{{ $data->pasien->Alamat ?? '-' }}</td>
                        <td>{{ $data->tanggal ?? '-' }}</td>
                        <td>{{ $data->datapoli->poli ?? '-' }}</td>
                        <td>{{ $data->datadokter->nama_dokter ?? '-' }}</td>
                        <td>{{ $data->diagnosa }}</td>
                        <td>{{ $data->tindakan }}</td>
                        <td>{{ $data->obat }}</td>
                        <td>Rp{{ number_format($data->biaya, 0, ',', '.') }}</td>
                    </tr>
                {{-- @endforeach --}}
            {{-- @endif --}}

        </tbody>
    </table>
</body>
</html>





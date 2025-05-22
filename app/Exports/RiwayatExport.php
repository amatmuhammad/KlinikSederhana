<?php

namespace App\Exports;


use App\Models\riwayat;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RiwayatExport implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return riwayat::with('pasien','datadokter','datapoli')->get();
    }

    public function headings():array {
        return ['id',
                'nik',
                'nama',
                'tanggal_lahir',
                'jenis_kelamin',
                'alamat',
                'Tanggal_Kunjungan',
                'Poli_Tujuan',
                'Nama_Dokter',
                'Diagnosa',
                'Tindakan',
                'Obat_Diberikan',
                'Biaya_total',

        ];
    }

    public function map($row): array
    {
            // dd($row);

        return [
            $row->id,
            $row->pasien->nik,
            $row->pasien->nama ?? '-',
            $row->pasien->tanggal_lahir ?? '-',
            $row->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $row->pasien->alamat ?? '-',
            $row->tanggal ?? '-',
            $row->datapoli->poli ?? '-',
            $row->datadokter->nama_dokter ?? '-',
            $row->diagnosa ?? '-',
            $row->tindakan ?? '-',
            $row->obat ?? '-',
            $row->biaya ? 'Rp ' . number_format($row->biaya, 0, ',', '.') : '-',

        ];
    }
}

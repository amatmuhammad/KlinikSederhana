<?php

namespace App\Models;

use App\Models\pasien;
use App\Models\datapoli;
use App\Models\datadokter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayat_kunjungan';

    protected $fillable = [
        'pasien_id',
        'nama_dokter',
        'dokter_id',
        'poli_id',
        'tanggal',
        'diagnosa',
        'tindakan',
        'obat',
        'biaya',
        
    ];

    public function pasien()
    {
        return $this->belongsTo(pasien::class, 'pasien_id', 'id');
    }

    public function datadokter()
    {
        return $this->belongsTo(datadokter::class, 'dokter_id', 'id');
    }

    public function datapoli()
    {
        return $this->belongsTo(datapoli::class, 'poli_id', 'id');
    }
}

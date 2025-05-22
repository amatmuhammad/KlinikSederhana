<?php

namespace App\Models;

use App\Models\riwayat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'nik',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'foto'
    ];

    public function riwayat()
    {
        return $this->hasMany(riwayat::class, 'pasien_id','id');
    }

    
}

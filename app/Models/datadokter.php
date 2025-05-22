<?php

namespace App\Models;

use App\Models\riwayat;
use App\Models\datapoli;
// use App\Models\datadokter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class datadokter extends Model
{
    use HasFactory;

     use HasFactory;

    protected $table = 'datadokter';

    protected $fillable = [
        'nama_dokter',
        'datapoli_id',
        'spesialis',
        
    ];

    public function riwayat()
    {
        return $this->hasMany(riwayat::class,'dokter_id','id');
    }

    public function datapoli()
    {
        return $this->belongsTo(datapoli::class, 'datapoli_id');
    }
}

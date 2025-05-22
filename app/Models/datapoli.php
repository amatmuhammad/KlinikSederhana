<?php

namespace App\Models;

use App\Models\riwayat;
use App\Models\datadokter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class datapoli extends Model
{
    use HasFactory;

    protected $table = 'datapoli';

    protected $fillable = [
        'poli',
        
    ];

    public function riwayat()
    {
        return $this->hasMany(riwayat::class);
    }

    public function datadokter()
    {
        return $this->hasMany(datadokter::class);
    }
}

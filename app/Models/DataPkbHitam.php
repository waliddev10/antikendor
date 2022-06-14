<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPkbHitam extends Model
{
    protected $table = 'data_pkb_hitam';

    protected $fillable = [
        'no_pol',
        'nama',
        'alamat',
        'jenis_kendaraan',
        'merk_kendaraan',
        'mesin_kendaraan',
        'status_kendaraan',
        'no_hp',
        'nilai_pokok_pkb',
        'nilai_denda_pkb',
        'tgl_akhir_pkb',
        'tgl_akhir_stnk',
    ];
}

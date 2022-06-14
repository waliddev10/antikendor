<?php

namespace App\Imports;

use App\Models\DataPkbHitam;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DataPkbHitamImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DataPkbHitam([
            'no_pol' => $row[1],
            'nama' => $row[2],
            'alamat' => $row[3],
            'jenis_kendaraan' => $row[4],
            'merk_kendaraan' => $row[5],
            'mesin_kendaraan' => $row[6],
            'status_kendaraan' => $row[7],
            'no_hp' => $row[8],
            'nilai_pokok_pkb' => $row[9],
            'nilai_denda_pkb' => $row[10],
            'tgl_akhir_pkb' => (is_null($row[11]) ? null : (is_numeric($row[11]) ? gmdate("Y-m-d", ($row[11] - 25569) * 86400) : $row[11])),
            'tgl_akhir_stnk' => (is_null($row[12]) ? null : (is_numeric($row[12]) ? gmdate("Y-m-d", ($row[12] - 25569) * 86400) : $row[12])),
        ]);
    }
}

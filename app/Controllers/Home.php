<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $stokterbanyak = $db->query("
            SELECT 
                kode_barang, 
                nama_barang, 
                stok, 
                pkm,
                (stok - pkm) AS var,
                CASE 
                    WHEN stok >= 2*pkm THEN 'Over 2*pkm'
                    WHEN stok >= 1.5*pkm THEN 'Over 1.5*pkm'
                    WHEN stok > pkm THEN 'Over'
                    WHEN stok = pkm THEN 'Aman'
                    ELSE 'Under'
                END AS status
            FROM master_atk
            ORDER BY stok DESC
            LIMIT 5
        ")->getResult();

        //  ✅ Query tambahan — bagian dengan pengeluaran terbanyak
        $databagian = $db->query("
            SELECT 
                k.bagian,
                COUNT(a.nik) AS total_transaksi,
                SUM(a.total_harga) AS total_rupiah
            FROM 
                atk_keluar a
            JOIN 
                karyawan k ON a.nik = k.nik
            GROUP BY 
                k.bagian
            ORDER BY 
                total_rupiah DESC
                LIMIT 5
        ")->getResult();

        $data = [
            'stokterbanyak' => $stokterbanyak,
            'keluarbagian'   => $databagian
        ];

        return view('home.php', $data);
    }

    public function generate()
    {
        echo password_hash('12345', PASSWORD_BCRYPT);
    }
}

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
                    WHEN stok = pkm THEN 'Aman'
                    ELSE 'Kurang'
                END AS status
            FROM master_atk
            ORDER BY stok DESC
            LIMIT 5
        ")->getResult();

        $data = ['stokterbanyak' => $stokterbanyak];
        return view('home.php', $data);
    }

    public function generate()
    {
        echo password_hash('12345', PASSWORD_BCRYPT);
    }

    public function stokterbanyak(){
        $db = Database::connect();

        $stokterbanyak = $db->query("
            SELECT 
            kode_barang, 
            nama_barang, 
            stok, 
            pkm,
            CASE 
                WHEN stok >= 2*pkm THEN 'Over 2*pkm'
                WHEN stok >= 1.5*pkm THEN 'Over 1.5*pkm'
                WHEN stok = pkm THEN 'Aman'
                ELSE 'Kurang'
            END AS status
        FROM master_atk
        ORDER BY stok DESC
        LIMIT 5
        ")->getResult();

        $data = ['stokterbanyak' => $stokterbanyak];
        return view('home', $data);
    }
}

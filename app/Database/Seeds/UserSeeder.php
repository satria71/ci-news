<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nik' => '2015496800',
            'nama_karyawan' => 'Satria Putra Sabana',
            'bagian' => 'Admin',
            'jabatan' => 'SPV',
            'password' => password_hash('125', PASSWORD_BCRYPT),
            'tgl_tambah' => date("Y/m/d"),
        ];
        $this->db->table('login_user')->insert($data);
    }
}

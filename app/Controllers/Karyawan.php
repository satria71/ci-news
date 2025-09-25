<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Karyawan extends BaseController
{
    public function index()
    {
        //
    }

    public function formtambah(){
        $json = [
            'data' => view('karyawan/modaltambah')
        ];

        echo json_encode($json);
    }

    public function simpan(){
        $nik = $this->request->getPost('nikmod');
        $nama_karyawan = $this->request->getPost('nama_karyawan');
        $bagian = $this->request->getPost('bagian');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'nikmod' => [
                'rules' => 'required',
                'label' => 'NIK',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if(!$valid){
            $json = [
                'error' => [
                    'errnik' => $validation->getError(),
                ]
            ];
        }

        echo json_encode($json);
    }
}

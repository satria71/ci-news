<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Modelvoucher;

class Voucher extends BaseController
{
    public function __construct()
    {
        $this->voucher = new Modelvoucher();
    }

    public function index()
    {
        $data = [
            'tampildata' => $this->voucher->findAll()
        ];

        return view ('voucher/viewmastervoucher', $data);
    }

    public function formtambah()
    {
        return view ('voucher/formtambah');
    }

    public function simpandata()
    {
        $plu = $this->request->getVar('plu');
        $namabarang = $this->request->getVar('nama_barang');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'plu' => [
                'rules' => 'required|is_unique[voucher.plu]',
                'label' => 'PLU',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        // $exists = $this->voucher->find($plu);

        // if($exists){
        //     session()->setFlashdata('error', 'Data dengan plu ini sudah ada');
        // }else{

        // }

        if(!$valid){
            $pesan = [
                // 'error' => $validation->getError()
                'error' => 'Data dengan PLU tersebut sudah ada'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/voucher/formtambah');
        }else{
            $this->voucher->insert([
                'plu' => $plu,
                'desc' => $namabarang
            ]);

            $pesan = [
                'success' => 'Data berhasil disimpan'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/voucher');
        }
    }

    public function formedit($id)
    {
        $rowData = $this->voucher->find($id);

        if($rowData){
            $data = [
                'id' => $id,
                'desc' => $rowData['desc']
            ];
            return view('voucher/formedit', $data);
        }else{
            exit('Data tidak ditemukan');
        }
    }
}

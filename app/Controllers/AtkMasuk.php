<?php

namespace App\Controllers;

class AtkMasuk extends BaseController
{
    public function index()
    {
        return view('atk/forminputatkmasuk');
    }

    public function tampildatatemp($sj){
        $db      = \Config\Database::connect();
        $builder = $db->table('temp_atk_masuk'); 
        $builder->select('temp_atk_masuk.det_sj, temp_atk_masuk.det_kode_barang, master_atk.harga, temp_atk_masuk.det_jumlah, temp_atk_masuk.det_subtotal, master_atk.kode_barang, master_atk.nama_barang')
        ->join('master_atk', 'master_atk.kode_barang = temp_atk_masuk.det_kode_barang')   // join manual
        ->where('temp_atk_masuk.det_sj',$sj);

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function datatemp(){

        if($this->request->isAJAX()){
            $sj = $this->request->getPost('sj');

            $data = [
                'datatemp' => $this->tampildatatemp($sj)
            ];

            $json = [
                'data' => view('atk/datatemp',$data)
            ];
            echo json_encode($json);
        }else{
            exit('maaf data tidak dipanggil');
        }
    }
}
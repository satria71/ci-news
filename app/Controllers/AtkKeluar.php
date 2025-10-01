<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AtkKeluar extends BaseController
{
    public function nosjotomatis($tanggalSekarang){
        $db      = \Config\Database::connect();
        $builder = $db->table('atk_keluar');
        $builder->select('max(no_sj) as nosj')
                ->where('tgl', $tanggalSekarang);
                
        $query = $builder->get();
        // $data = $query->getResult();
        
        return $query;
    }

    public function buatnosj(){
        $tanggalSekarang = date('Y-m-d');
        $hasil = $this->nosjotomatis($tanggalSekarang)->getRowArray();
        $data = $hasil['nosj'];

        $lastnourut = substr($data, -4);
        $nextnourut = intval($lastnourut) + 1;
        $nosj = date('dmy', strtotime($tanggalSekarang)). sprintf('%04s', $nextnourut);
        return $nosj;
    }

    public function buatnosjinputan(){
        $tanggalSekarang = $this->request->getPost('tanggal');
        $hasil = $this->nosjotomatis($tanggalSekarang)->getRowArray();
        $data = $hasil['nosj'];

        $lastnourut = substr($data, -4);
        $nextnourut = intval($lastnourut) + 1;
        $nosj = date('dmy', strtotime($tanggalSekarang)). sprintf('%04s', $nextnourut);
        
        $json = [
            'nosj' => $nosj
        ];
        echo json_encode($json);
    }

    public function index()
    {
        return view('atk/forminputatkmasuk');
    }
    
    public function data()
    {
        return view ('atkkeluar/viewdata');
    }

    public function input()
    {
        $data = [
            'no_sj' => $this->buatnosj()
        ];
        return view ('atkkeluar/forminputatkkeluar', $data);
    }

    public function tampildatatemp(string $no_sj): array{
        $db      = \Config\Database::connect();
        $builder = $db->table('temp_atk_keluar t'); 
        $builder->select(
            't.id,
             t.det_sj,
             t.det_kode_barang,
             m.nama_barang,
             m.harga,
             t.det_jumlah,
             t.det_subtotal')
        ->join('master_atk m', 'm.kode_barang = t.det_kode_barang')   // join manual
        ->where('t.det_sj',$no_sj);

        // log_message('debug', 'DEBUG tampildatatemp => ' . print_r(
        // $builder->getCompiledSelect(), true
        // ));
        // log_message('debug', 'DEBUG tampildatatemp data => ' . print_r(
        //     $builder->get()->getResultArray(), true
        // ));

        return $builder->get()->getResultArray();
    }

    // public function datatemp(){

    //     if($this->request->isAJAX()){
    //         $sj = (string) $this->request->getPost('sj');

    //         $data = [
    //             'datatemp' => $this->tampildatatemp($sj)
    //         ];

    //         $json = [
    //             'data' => view('atk/datatemp',$data)
    //         ];
    //         echo json_encode($json);
    //     }else{
    //         exit('maaf data tidak dipanggil');
    //     }
    // }

    public function datatemp(){
        if($this->request->isAJAX()){
            $no_sj = (string) $this->request->getPost('no_sj');

            $data = [
                'datatemp' => $this->tampildatatemp($no_sj)
            ];

            $json = [
                'data' => view('atkkeluar/datatemp',$data)
            ];
            echo json_encode($json);
        }else{
            exit('maaf data tidak dipanggil');
        }
    }
}

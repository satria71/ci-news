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
}

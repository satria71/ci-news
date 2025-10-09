<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{
    public function index()
    {
        return view('laporan/index');
    }

    public function cetakatkmasuk()
    {
        return view('laporan/viewatkmasuk');
    }

    public function laporanperperiode($tglawal, $tglakhir){
            $db      = \Config\Database::connect();
            $atkmasuk = $db->table('atk_masuk');
            $data = $atkmasuk->where('tgl >=', $tglawal)->where('tgl <=', $tglakhir)->get();
            return $data;
    }

    public function cetakatkmasukperiode()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');

        $datalaporan = $this->laporanperperiode($tglawal, $tglakhir);

        $data = [
            'datalaporan' => $datalaporan,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
        ];

        return view('laporan/cetaklaporanatkmasuk', $data);
    }

    public function tampilgrafikatkmasuk(){
        $bulan = $this->request->getPost('bulan');
        $db      = \Config\Database::connect();

        $query = $db->query("select tgl as tanggal, total_harga from atk_masuk where date_format(tgl,'%Y-%m')='$bulan' order by tgl asc")
        ->getResult();

        $data = [
            'grafik' => $query
        ];

        $json = [
            'data' => view('laporan/grafikatkmasuk', $data)
        ];

        echo json_encode($json);
    }
}

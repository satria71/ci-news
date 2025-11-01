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

    public function cetakatkkeluar()
    {
        return view('laporan/viewatkkeluar');
    }

    public function laporanperperiodemasuk($tglawal, $tglakhir){
            $db      = \Config\Database::connect();
            $atkmasuk = $db->table('atk_masuk');
            $data = $atkmasuk->where('tgl >=', $tglawal)->where('tgl <=', $tglakhir)->get();
            return $data;
    }

    public function cetakatkmasukperiode()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');

        $datalaporan = $this->laporanperperiodemasuk($tglawal, $tglakhir);

        $data = [
            'datalaporan' => $datalaporan,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
        ];

        return view('laporan/cetaklaporanatkmasuk', $data);
    }

    // public function laporanperperiodekeluar($tglawal, $tglakhir){
    //         $db      = \Config\Database::connect();
    //         $atkkeluar = $db->table('atk_keluar k');
    //         // $data = $atkmasuk->where('tgl >=', $tglawal)->where('tgl <=', $tglakhir)->get();
    //         $atkkeluar->select("
    //                 k.no_sj,
    //                 k.tgl,
    //                 k.total_harga,
    //                 COUNT(DISTINCT d.det_sj) AS total_item,
    //             ");
    //             $atkkeluar->join('detail_atk_keluar d', 'd.det_sj = k.no_sj', 'left');
    //             $atkkeluar->where('k.tgl >=', $tglawal);
    //             $atkkeluar->where('k.tgl <=', $tglakhir);
    //             $atkkeluar->groupBy('k.no_sj'); // Grup per surat jalan
    //             $atkkeluar->orderBy('k.tgl', 'ASC');

    //             $hasil = $atkkeluar->get()->getResultArray();
    //         return $hasil;
    // }

    public function laporanperperiodekeluar($tglawal, $tglakhir){
            $db      = \Config\Database::connect();
            $atkkeluar = $db->table('detail_atk_keluar d');
            // $data = $atkmasuk->where('tgl >=', $tglawal)->where('tgl <=', $tglakhir)->get();
            $atkkeluar->select("
                    d.det_kode_barang AS kode_barang,
                    ANY_VALUE(b.nama_barang) AS nama_barang,
                    SUM(d.det_jumlah) AS total_item,
                    SUM(d.det_subtotal) AS total_harga
                ");
                $atkkeluar->join('atk_keluar k', 'k.no_sj = d.det_sj');
                $atkkeluar->join('master_atk b', 'b.kode_barang = d.det_kode_barang');
                $atkkeluar->where('k.tgl >=', $tglawal);
                $atkkeluar->where('k.tgl <=', $tglakhir);
                $atkkeluar->groupBy('d.det_kode_barang');
                $atkkeluar->orderBy('total_harga', 'DESC');

                $hasil = $atkkeluar->get()->getResultArray();
            return $hasil;
    }

    public function cetakatkkeluarperiode()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');

        $datalaporan = $this->laporanperperiodekeluar($tglawal, $tglakhir);

        $data = [
            'datalaporan' => $datalaporan,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
        ];

        return view('laporan/cetaklaporanatkkeluar', $data);
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

    public function tampilgrafikatkkeluar(){
        $bulan = $this->request->getPost('bulan');
        $db      = \Config\Database::connect();

        $query = $db->query("
                    select 
                        date(tgl) as tanggal, 
                        sum(total_harga) as total_harga 
                    from atk_keluar 
                    where date_format(tgl,'%Y-%m')='$bulan' 
                    group by date(tgl) 
                    order by date(tgl) asc
        ")->getResult();

        $data = [
            'grafik' => $query
        ];

        $json = [
            'data' => view('laporan/grafikatkkeluar', $data)
        ];

        echo json_encode($json);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

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

    public function ambilstokbarang(string $kode_barang): array{
        $db      = \Config\Database::connect();
        $builder = $db->table('master_atk'); 
        $builder->select('stok')
        ->where('kode_barang',$kode_barang);

        // log_message('debug', 'DEBUG tampildatatemp => ' . print_r(
        // $builder->getCompiledSelect(), true
        // ));
        // log_message('debug', 'DEBUG tampildatatemp data => ' . print_r(
        //     $builder->get()->getResultArray(), true
        // ));

        return $builder->get()->getResultArray();
    }

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

    public function ambildatabarang(){
        if($this->request->isAJAX()){
            $kode_barang = $this->request->getPost('kode_barang');

            $db      = \Config\Database::connect();
            $builder = $db->table('master_atk'); 
            $query = $builder->where('kode_barang', $kode_barang)->get();
            $ambildata = $query->getRow();
            
            if($ambildata == NULL){
                $json = [
                    'error' => 'Data Barang Tidak Ditemukan...'
                ];
            }else{
                $data = [
                    'nama_barang' => $ambildata->nama_barang,
                    'harga' => $ambildata->harga
                ];

                $json = [
                    'sukses' => $data
                ];
            }

            echo json_encode($json);
        }else{
            exit('maaf data tidak dipanggil');
        }
    }

    public function simpantemp(){
        if($this->request->isAJAX()){
            $db      = \Config\Database::connect();
            $builder = $db->table('temp_atk_keluar'); 

            $sj = $this->request->getPost('sj');
            $kode_barang = $this->request->getPost('kode_barang');
            $harga_keluar = $this->request->getPost('harga_keluar');
            $jumlah = $this->request->getPost('jumlah');

            $data = [
                'det_sj' => $sj,
                'det_kode_barang' => $kode_barang,
                'det_harga_keluar' => $harga_keluar,
                'det_jumlah' => $jumlah,
                'det_subtotal' => intval($jumlah) * intval($harga_keluar)
            ];

            $stokbarang = $this->ambilstokbarang($kode_barang);
            if($jumlah > intval($stokbarang)){
                $json = [
                    'error' => 'Stok tidak mencukupi'
                ];
            }else{
                $builder->insert($data);

                $json = [
                    'sukses' => 'Item berhasil ditambahkan'
                ];
            }

            echo json_encode($json);
        }else{
            exit('maaf data tidak dipanggil');
        }
    }

    public function hapus(){
        if($this->request->isAJAX()){
            $db      = \Config\Database::connect();
            $builder = $db->table('temp_atk_keluar');

            $id = $this->request->getPost('id');
            
            $builder->where('id', $id);
            $builder->delete();

            $json = [
                'sukses' => 'Item berhasil dihapus'
            ];
            echo json_encode($json);

        }else{
            exit('maaf data tidak dipanggil');
        }
    }

    public function modalcaribarang(){
        if($this->request->isAJAX()){
            $json = [
                'data' => view('atkkeluar/modalcaribarang')
            ];
            echo json_encode($json);
        }else{
            exit('maaf data tidak dipanggil');
        }  
    }

    public function listdatabarang()
    {
        $request = Services::request();
        $db      = db_connect();

        // ===================== KONFIGURASI =====================
        $table         = 'master_atk';                  // ganti dengan nama tabel
        $columnOrder   = [null,'kode_barang','nama_barang','stok','harga',null];         // kolom yang bisa di-order
        $columnSearch  = ['kode_barang','nama_barang'];              // kolom yang bisa di-search
        $defaultOrder  = ['nama_barang' => 'DESC'];              // default order

        // ===================== BASE QUERY =====================
        $builder = $db->table($table);

        // -------- Search --------
        $search = $request->getPost('search')['value'] ?? null;
        if ($search) {
            $builder->groupStart();
            foreach ($columnSearch as $i => $col) {
                $i === 0
                    ? $builder->like($col, $search)
                    : $builder->orLike($col, $search);
            }
            $builder->groupEnd();
        }

        // -------- Order --------
        $orderPost = $request->getPost('order');
        if ($orderPost) {
            $colIndex = $orderPost[0]['column'];
            $dir      = $orderPost[0]['dir'];
            $builder->orderBy($columnOrder[$colIndex], $dir);
        } else {
            $builder->orderBy(key($defaultOrder), current($defaultOrder));
        }

        // -------- Paging --------
        $length = (int) $request->getPost('length');
        $start  = (int) $request->getPost('start');
        if ($length !== -1) {
            $builder->limit($length, $start);
        }

        // ===================== AMBIL DATA =====================
        $lists = $builder->get()->getResult();

        // ===================== HITUNG TOTAL/FILTERED =====================
        // total semua data (tanpa filter)
        $recordsTotal = $db->table($table)->countAllResults();

        // total data setelah filter
        $builderFilter = $db->table($table);
        if ($search) {
            $builderFilter->groupStart();
            foreach ($columnSearch as $i => $col) {
                $i === 0
                    ? $builderFilter->like($col, $search)
                    : $builderFilter->orLike($col, $search);
            }
            $builderFilter->groupEnd();
        }
        $recordsFiltered = $builderFilter->countAllResults();

        // ===================== FORMAT DATA UNTUK DATATABLES =====================
        $data = [];
        $no   = $start;
        foreach ($lists as $list) {
            $no++;
            $row   = [];
            $tombolpilih = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"pilih('".$list->kode_barang."')\">
            <i class=\"fas fa-hand-pointer\"></i></button>";
            // $tombolhapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('".$list->id."',
            // '".$list->nik."','".$list->nama_karyawan."','".$list->bagian."')\"><i class=\"fas fa-trash-alt\"></i></button>";
            $row[] = $no;             // contoh nomor urut
            $row[] = $list->kode_barang;             // contoh nomor urut
            $row[] = $list->nama_barang;     // contoh kolom
            $row[] = number_format($list->stok,0,",",".");
            $row[] = number_format($list->harga,0,",",".");
            $row[] = $tombolpilih;
            // tambahkan kolom lain sesuai kebutuhan
            $data[] = $row;
        }

        $output = [
            "draw"            => $request->getPost('draw'),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $data
        ];

        return $this->response->setJSON($output);
    }
}

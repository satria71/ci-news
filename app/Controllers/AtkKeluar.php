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

    public function tampildatadetail(string $no_sj): array{
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_atk_keluar t'); 
        $builder->select(
            't.id,
             t.det_sj,
             t.det_kode_barang,
             m.nama_barang,
             m.harga,
             m.satuan,
             t.det_harga_keluar,
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

    public function ambilstokbarang(string $kode_barang): int{
        $db      = \Config\Database::connect();
        $builder = $db->table('master_atk'); 
        $builder->select('stok')
        ->where('kode_barang',$kode_barang);
        $result = $builder->get()->getRowArray();

        // log_message('debug', 'DEBUG tampildatatemp => ' . print_r(
        // $builder->getCompiledSelect(), true
        // ));
        // log_message('debug', 'DEBUG tampildatatemp data => ' . print_r(
        //     $builder->get()->getResultArray(), true
        // ));

        return $result ? intval($result['stok']) : 0;
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

            if($jumlah > $stokbarang){
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

    public function hapusdatatemp($no_sj){
        $db      = \Config\Database::connect();
        $buildertemp = $db->table('temp_atk_keluar');
        $buildertemp->where('det_sj', $no_sj);
        $deleted = $buildertemp->delete();

        return $deleted; // return true/false sesuai hasil
    }

    public function selesaitransaksi(){
        if($this->request->isAJAX()){
            $db      = \Config\Database::connect();
            $buildertemp = $db->table('temp_atk_keluar');

            $no_sj = $this->request->getPost('no_sj');
            $tgl = $this->request->getPost('tgl');
            $nik = $this->request->getPost('nik');
            $total_harga = $this->request->getPost('total_harga');

            $query = $buildertemp->where('det_sj', $no_sj)->get();
            $datatemp = $query->getResultArray();
            
            $cekdata = $this->tampildatatemp($no_sj);

            if(count($cekdata) > 0){
                $db      = \Config\Database::connect();
                $builder = $db->table('atk_keluar');
                $builder2 = $db->table('detail_atk_keluar');
                
                $data = [
                    'no_sj' => $no_sj,
                    'tgl' => $tgl,
                    'nik' => $nik,
                    'total_harga' => $total_harga
                ];

                $builder->insert($data);

                //simpan ke table detail atk masuk
                foreach ($datatemp as $row) :
                    $data2 = [
                        'det_sj' => $row['det_sj'],
                        'det_kode_barang' => $row['det_kode_barang'],
                        'det_harga_keluar' => $row['det_harga_keluar'],
                        'det_jumlah' => $row['det_jumlah'],
                        'det_subtotal' => $row['det_subtotal'],
                    ];

                    $builder2->insert($data2);
                endforeach;

            
                //hapus data di table temp
                // $buildertemp->$this->hapusdatatemp($no_sj);
                $this->hapusdatatemp($no_sj);

                $json = [
                    'sukses' => 'Transaksi berhasil disimpan',
                    'cetaksj' => site_url('atkkeluar/cetaksj/'. $no_sj)
                ];
            }else{
                $json = [
                    'error' => 'Maaf item masih kosong'
                ];
            }
        }else{
            exit('maaf data tidak dipanggil');
        }

        echo json_encode($json);

    }

    public function cetaksj($no_sj){
        $db      = \Config\Database::connect();
        $atk_keluar = $db->table('atk_keluar');
        $det_atk_keluar = $db->table('detail_atk_keluar');
        $karyawan = $db->table('karyawan');

        $cekdata = $atk_keluar->where('no_sj', $no_sj)->get()->getRowArray();
        $datakaryawan = $karyawan->where('nik', $cekdata['nik'])->get()->getRowArray();

        $namakaryawan = ($datakaryawan != null) ? $datakaryawan['nama_karyawan'] : "-";
        $bagiankaryawan = ($datakaryawan != null) ? $datakaryawan['bagian'] : "-";

        if($cekdata != null){
            $data = [
                'no_sj' => $no_sj,
                'tgl' => $cekdata['tgl'],
                'namakaryawan' => $namakaryawan,
                'bagian' => $bagiankaryawan,
                'detailatk' => $this->tampildatadetail($no_sj)
            ];

            return view('atkkeluar/cetaksj', $data);
        }else{
            return redirect()->to(site_url('atkkeluar/input'));
        }
    }

    public function listdata()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');

        $request = Services::request();
        $db      = db_connect();

        // ===================== KONFIGURASI =====================
        $table         = 'atk_keluar a';                  // ganti dengan nama tabel
        $columnOrder   = [null,'a.no_sj','a.tgl','k.nama_karyawan','k.bagian','a.total_harga',null];         // kolom yang bisa di-order
        $columnSearch  = ['a.no_sj','k.nama_karyawan','k.bagian'];              // kolom yang bisa di-search
        $defaultOrder  = ['a.no_sj' => 'DESC'];              // default order

        // ===================== BASE QUERY =====================
        $builder = $db->table($table);
        $builder->select('a.no_sj, a.tgl, a.total_harga, k.nik, k.nama_karyawan, k.bagian');
        $builder->join('karyawan k', 'k.nik = a.nik', 'left');
        
        // -------- Filter tanggal (jika ada) --------
        if (!empty($tglawal) && !empty($tglakhir)) {
            $builder->where('a.tgl >=', $tglawal);
            $builder->where('a.tgl <=', $tglakhir);
        }

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
        $recordsTotal = $db->table('atk_keluar')->countAllResults();

        // total data setelah filter
        $builderFilter = $db->table('atk_keluar a');
        $builderFilter->join('karyawan k', 'k.nik = a.nik', 'left');
        if (!empty($tglawal) && !empty($tglakhir)) {
            $builderFilter->where('a.tgl >=', $tglawal);
            $builderFilter->where('a.tgl <=', $tglakhir);
        }
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
            $tombolcetak = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"cetak('".$list->no_sj."')\">
            <i class=\"fas fa-print\"></i></button>";
            $tomboledit = "<button type=\"button\" class=\"btn btn-sm btn-warning\" onclick=\"edit('".$list->no_sj."')\">
            <i class=\"fas fa-edit\"></i></button>";
            $tombolhapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('".$list->no_sj."')\">
            <i class=\"fas fa-trash-alt\"></i></button>";
            
            $row[] = $no;             // contoh nomor urut
            $row[] = $list->no_sj;             // contoh nomor urut
            $row[] = $list->tgl;     // contoh kolom
            $row[] = $list->nama_karyawan;
            $row[] = $list->bagian;
            $row[] = number_format($list->total_harga,0,',','.');
            $row[] = $tombolcetak . " " . $tomboledit . " " . $tombolhapus;
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

    public function hapustransaksi(){
        if($this->request->isAJAX()){
            $db      = \Config\Database::connect();
            $atk_keluar = $db->table('atk_keluar');
            $detail_atk_keluar = $db->table('detail_atk_keluar');

            $no_sj = $this->request->getPost('no_sj');
            
            $atk_keluar->where('no_sj', $no_sj);
            $atk_keluar->delete();
            $detail_atk_keluar->where('det_sj', $no_sj);
            $detail_atk_keluar->delete();

            $json = [
                'sukses' => 'Transaksi berhasil dihapus'
            ];
            echo json_encode($json);

        }else{
            exit('maaf data tidak dipanggil');
        }
    }

    public function edit($no_sj){
        $db      = \Config\Database::connect();
        $atk_keluar = $db->table('atk_keluar');
        $karyawan = $db->table('karyawan');

        $rowdata = $atk_keluar->where('no_sj', $no_sj)->get()->getRowArray();
        $datakaryawan = $karyawan->where('nik', $rowdata['nik'])->get()->getRowArray();

        $namakaryawan = ($datakaryawan != null) ? $datakaryawan['nama_karyawan'] : "-";
        $bagiankaryawan = ($datakaryawan != null) ? $datakaryawan['bagian'] : "-";

        if($rowdata != null){
            $data = [
                'no_sj' => $no_sj,
                'tgl' => $rowdata['tgl'],
                'nama_karyawan' => $namakaryawan,
                'bagian' => $bagiankaryawan,
                'detailatk' => $this->tampildatadetail($no_sj)
            ];
        }

        return view('atkkeluar/formedit', $data);
    }

    public function ambiltotalharga($no_sj){
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_atk_keluar')->getWhere([
            'det_sj' => $no_sj
        ]);
        $totalharga = 0;
        
        foreach($builder->getResultArray() as $ar){
            $totalharga += $ar['det_subtotal'];
        }
        
        return $totalharga;
    }

    public function datadetailsj($no_sj){
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_atk_keluar d');
        $builder->select(
            'm.kode_barang,
             d.id,
             d.det_sj,
             m.nama_barang,
             m.harga,
             d.det_kode_barang,
             d.det_harga_keluar,
             d.det_jumlah,
             d.det_subtotal')
        ->join('master_atk m', 'd.det_kode_barang = m.kode_barang', 'left')   // join manual
        ->where('d.det_sj', $no_sj);

        $query = $builder->get();
        $data = $query->getResultArray();
        return ($data);
    }

    public function totalharga(){
        if($this->request->isAJAX()){
            $sj = (string) $this->request->getPost('no_sj');

            $data = [
                'datadetailsj' => $this->datadetailsj($sj)
            ];

            $totalhargasj = number_format($this->ambiltotalharga($sj),0,",",".");

            $json = [
                // 'data' => view('atk/formedit',$data),
                'totalharga' => "Rp. ". $totalhargasj
            ];
            echo json_encode($json);
        }else{
            exit('maaf data tidak dipanggil');
        }
    }

    public function datadetail(){
        if($this->request->isAJAX()){
            $sj = (string) $this->request->getPost('no_sj');

            $data = [
                'datatemp' => $this->tampildatadetail($sj)
            ];

            $json = [
                'data' => view('atkkeluar/datadetail',$data)
            ];
            echo json_encode($json);
        }else{
            exit('maaf data tidak dipanggil');
        }
    }
}

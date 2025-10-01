<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

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

    public function ambildataterkahir(){
        $db      = \Config\Database::connect();
        $builder = $db->table('karyawan');
        $query = $builder->limit(1)
                        ->orderBy('id','DESC')
                        ->get();

        return $query;
    }

    public function simpan(){
        $nik = $this->request->getPost('nikmod');
        $nama_karyawan = $this->request->getPost('nama_karyawanmod');
        $bagian = $this->request->getPost('bagianmod');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'nikmod' => [
                'rules' => 'required|is_unique[karyawan.nik]',
                'label' => 'NIK',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada, tidak boleh sama'
                ]
            ],
            'nama_karyawanmod' => [
                'rules' => 'required',
                'label' => 'Nama Karyawan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'bagianmod' => [
                'rules' => 'required',
                'label' => 'Bagian',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ]);

        if(!$valid){
            $json = [
                'error' => [
                    'errnik' => $validation->getError('nikmod'),
                    'errnama' => $validation->getError('nama_karyawanmod'),
                    'errbagian' => $validation->getError('bagianmod'),
                ]
            ];
        }else{
            $db      = \Config\Database::connect();
            $builder = $db->table('karyawan');
            $data = [
                'nik' => $nik,
                'nama_karyawan' => $nama_karyawan,
                'bagian' => $bagian
            ];

            $builder->insert($data);

            $rowdata = $this->ambildataterkahir()->getRowArray();

            $json = [
                'sukses' => 'Data karyawan berhasil disimpan, ambil data terakhir?',
                'id' => $rowdata['id'],
                'nama_karyawan' => $rowdata['nama_karyawan'],
                'nik' => $rowdata['nik'],
                'bagian' => $rowdata['bagian']
            ];
        }

        echo json_encode($json);
    }

    public function modaldatakaryawan(){
        if($this->request->isAJAX()){
            $json = [
                'data' => view('karyawan/modaldatakaryawan')
            ];
        }
        echo json_encode($json);
    }

    //DATA TABLE SERVERSIDE
    public function listdata()
    {
        $request = Services::request();
        $db      = db_connect();

        // ===================== KONFIGURASI =====================
        $table         = 'karyawan';                  // ganti dengan nama tabel
        $columnOrder   = [null,'nik','nama_karyawan','bagian',null];         // kolom yang bisa di-order
        $columnSearch  = ['nik','nama_karyawan','bagian'];              // kolom yang bisa di-search
        $defaultOrder  = ['id' => 'DESC'];              // default order

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
            $tombolpilih = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"pilih('".$list->id."',
            '".$list->nik."','".$list->nama_karyawan."','".$list->bagian."')\"><i class=\"fas fa-hand-pointer\"></i></button>";
            $tombolhapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('".$list->id."',
            '".$list->nik."','".$list->nama_karyawan."','".$list->bagian."')\"><i class=\"fas fa-trash-alt\"></i></button>";
            $row[] = $no;             // contoh nomor urut
            $row[] = $list->nik;             // contoh nomor urut
            $row[] = $list->nama_karyawan;     // contoh kolom
            $row[] = $list->bagian;
            $row[] = $tombolpilih . " " . $tombolhapus;
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

    function hapus(){
        if($this->request->isAJAX()){
            $db      = \Config\Database::connect();
            $builder = $db->table('karyawan');

            $id = $this->request->getPost('id');
            
            $builder->where('id', $id);
            $builder->delete();

            $json = [
                'sukses' => 'Data karyawan berhasil dihapus'
            ];
            echo json_encode($json);

        }else{
            exit('maaf data tidak dipanggil');
        }
    }
}

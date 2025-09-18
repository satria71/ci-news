<?php

namespace App\Controllers;

class AtkMasuk extends BaseController
{
    public function index()
    {
        return view('atk/forminputatkmasuk');
    }

    public function tampildatatemp(string $sj): array{
        $db      = \Config\Database::connect();
        $builder = $db->table('temp_atk_masuk t'); 
        $builder->select(
            't.id,
             t.det_sj,
             t.det_kode_barang,
             m.nama_barang,
             t.det_harga,
             t.det_harga_masuk,
             t.det_jumlah,
             t.det_subtotal')
        ->join('master_atk m', 'm.kode_barang = t.det_kode_barang')   // join manual
        ->where('t.det_sj',$sj);

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
            $sj = (string) $this->request->getPost('sj');

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
            $builder = $db->table('temp_atk_masuk'); 

            $sj = $this->request->getPost('sj');
            $kode_barang = $this->request->getPost('kode_barang');
            $harga = $this->request->getPost('harga');
            $harga_beli = $this->request->getPost('harga_beli');
            $jumlah = $this->request->getPost('jumlah');

            $data = [
                'det_sj' => $sj,
                'det_kode_barang' => $kode_barang,
                'det_harga' => $harga,
                'det_harga_masuk' => $harga_beli,
                'det_jumlah' => $jumlah,
                'det_subtotal' => intval($jumlah) * intval($harga_beli)
            ];

            $builder->insert($data);

            // var_dump($this->request->getPost());

            $json = [
                'sukses' => 'Item berhasil ditambahkan'
            ];

            echo json_encode($json);
        }else{
            exit('maaf data tidak dipanggil');
        }
    }

    public function hapus(){
        if($this->request->isAJAX()){
            $db      = \Config\Database::connect();
            $builder = $db->table('temp_atk_masuk');

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

    public function caridatabarang(){
        if($this->request->isAJAX()){
            $json = [
                'data' => view('atk/modalcaribarang')
            ];
            echo json_encode($json);
        }else{
            exit('maaf data tidak dipanggil');
        }  
    }

    public function modaldetailcaribarang(){
        if($this->request->isAJAX()){
        $db      = \Config\Database::connect();
        $builder = $db->table('master_atk');

        $cari = $this->request->getPost('cari');
        
        $builder->groupStart() // buka grup WHERE
            ->like('kode_barang', $cari)
            ->orLike('nama_barang', $cari)
            ->groupEnd();
        
        $query = $builder->get();
        $data = $query->getResultArray();
        
        if($data != NULL){
            $json = [
                'data' => view('atk/modaldetaildatabarang',[
                    'tampildata' => $data
                ])
            ];

            echo json_encode($json);
        }

        }else{
            exit('maaf data tidak dipanggil');
        } 
    }

    public function selesaitransaksi(){
        if($this->request->isAJAX()){
            $db      = \Config\Database::connect();
            $buildertemp = $db->table('temp_atk_masuk');

            $sj = $this->request->getPost('sj');
            $tgl = $this->request->getPost('tgl');

            $query = $buildertemp->where('det_sj', $sj)->get();
            $datatemp = $query->getResultArray();

            if($datatemp == 0){
                $json = [
                    'error' => 'Maaf, data item untuk SJ ini belum ada'
                ];
            }else{
                // simpan ke table atk masuk
                $db      = \Config\Database::connect();
                $builder = $db->table('atk_masuk');
                $builder2 = $db->table('detail_atk_masuk');
                
                $totalsubtotal = 0;
                foreach($datatemp as $total) :
                    $totalsubtotal += intval($total['det_subtotal']);
                endforeach;
                
                $data = [
                    'no_sj' => $sj,
                    'tgl' => $tgl,
                    'total_harga' => $totalsubtotal
                ];

                $builder->insert($data);

                //simpan ke table detail atk masuk
                foreach ($datatemp as $row) :
                    $data2 = [
                        'det_sj' => $row['det_sj'],
                        'det_kode_barang' => $row['det_kode_barang'],
                        'det_harga_masuk' => $row['det_harga_masuk'],
                        'det_jumlah' => $row['det_jumlah'],
                        'det_subtotal' => $row['det_subtotal'],
                    ];

                    $builder2->insert($data2);
                endforeach;

                //hapus data di table temp
                $buildertemp->emptyTable();

                $json = [
                    'sukses' => 'Transaksi berhasil disimpan'
                ];
            }

            echo json_encode($json);
        }else{
            exit('maaf data tidak dipanggil');
        } 
    }
}
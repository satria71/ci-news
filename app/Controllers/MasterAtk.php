<?php

namespace App\Controllers;

class MasterAtk extends BaseController
{
    public function index()
    {
        //query builder
        $db      = \Config\Database::connect();
        // $builder = $db->table('master_atk'); 
        // $query = $builder->get()->getResult();
        // $data ['master_atk'] = $query;
        // return view('atk/getmasteratk', $data);

        //manual
        $query = $this->db->query("SELECT * FROM master_atk");
        $data['master_atk'] = $query->getResult();
        return view('atk/getmasteratk', $data);
    }

    public function create()
    {
        return view('atk/createmasteratk');
    }

    public function store()
    {
        //cara 1
        // $data = $this->request->getPost();

        //cara 2
        $data = [
            'id' => $this->request->getVar('id'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'harga' => $this->request->getVar('harga'),
            'satuan' => $this->request->getVar('satuan'),
            'tgl_tambah' => $this->request->getVar('tgl_tambah'),
        ];
            
        $this->db->table('master_atk')->insert($data);

        if($this->db->affectedRows() > 0){
            return redirect()->to(site_url('masteratk'))->with('success','Data Berhasil Disimpan');
        }
    }

    // public function edit($id = null){
    //     // $db      = \Config\Database::connect();
    //     if($id != null){
    //         $query = $this->db->table('master_atk')->getWhere(['id_barang_atk'=> $id]);
    //         // print_r($query);
    //         if($query->resultID->num_rows > 0){
    //             $data['master_atk'] = $query->getRow();
    //             return view('atk/editmasteratk', $data);
    //         }else{
    //             throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //         }
    //     }else{
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //     }
    // }

    public function update($id){
        $data = $this->request->getPost();
        unset($data['_method']);

        $this->db->table('master_atk')->where(['id'=> $id])->update($data);
        return redirect()->to(site_url('masteratk'))->with('success','Data Berhasil Diupdate');
    }

    // public function delete($id){
    //     $this->db->table('master_atk')->where(['id_barang_atk'=> $id])->delete();
    //     return redirect()->to(site_url('masteratk'))->with('success','Data Berhasil Dihapus');
    // }

     // === Hapus Data ===
    public function delete()
    {
        $id = $this->request->getPost('id');

        if (!$id) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'ID tidak ditemukan'
            ]);
        }

        $builder = $this->db->table('master_atk');
        $deleted = $builder->delete(['id' => $id]);

        if ($deleted) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Gagal menghapus data'
            ]);
        }
    }

    public function editdata($id)
    {

        $builder = $this->db->table('master_atk');
        $data = $builder->where('id', $id)->get()->getRow();

        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan'
            ])->setStatusCode(404);
        }
    }

    public function proseseditdata(){

        $id     = $this->request->getPost('id');
        $nama   = $this->request->getPost('nama_barang');
        $harga  = $this->request->getPost('harga');
        $satuan = $this->request->getPost('satuan');
        $tgl    = $this->request->getPost('tgl_tambah');

        log_message('debug', 'POST DATA: ' . json_encode($this->request->getPost()));

        $builder = $this->db->table('master_atk');
        $update = $builder->where('id', $id)->update([
            'nama_barang' => $nama,
            'harga'       => $harga,
            'satuan'      => $satuan,
            'tgl_tambah'  => $tgl,
        ]);

        if ($update) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil diperbarui'
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Gagal update data'
            ])->setStatusCode(500);
        }
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $data = [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga'       => $this->request->getPost('harga'),
            'satuan'      => $this->request->getPost('satuan'),
            'tgl_tambah'  => $this->request->getPost('tgl_tambah'),
        ];

        $builder = $this->db->table('master_atk');

        if ($id) {
            // Update
            $builder->where('id', $id)->update($data);
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil diperbarui'
            ]);
        } else {
            // ✅ Cek duplikat kode_barang sebelum insert
            $cek = $builder->where('kode_barang', $data['kode_barang'])->get()->getRow();

            if ($cek) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Kode barang sudah ada, gunakan kode lain.'
                ]);
            }
            // Insert
            $builder->insert($data);
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Data berhasil ditambahkan'
            ]);
        }
    }


    public function dt_masteratk()
	{
        $db      = \Config\Database::connect();
        $query = $this->db->query("SELECT * FROM master_atk");
        $data = $query->getResult();
			// ->from('group_questions as a')
			// ->join('subtests as b', 'b.id = a.subtest_id', 'left')
			// ->join('questions as c', 'c.group_question_id = a.id', 'left')
			// ->group_by('a.id')
			// ->get()
			// ->result();

        // var_dump($data);
        // die;

		// prettyPrint($data);

		$output['data'] = [];
		foreach ($data as $key => $val) {

			$data_detail = json_encode($val);
			$data_detail = htmlspecialchars($data_detail, ENT_QUOTES, 'UTF-8');

			$arr = array();

			$arr[] = (int)$key + 1;
            $arr[] = $val->kode_barang;
			$arr[] = $val->nama_barang;
			$arr[] = $val->harga;
			$arr[] = $val->satuan;
			$arr[] = $val->tgl_tambah;
			$arr[] = '
			<button id="view" data-detail="' . $data_detail . '" class="btn btn-sm btn-icon btn-info waves-effect" title="detail data">
                <i class="fas fa-info"></i>
            </button>

			<button id="edit" data-detail="' . $data_detail . '" class="btn btn-sm btn-icon btn-warning waves-effect" title="edit data">
                <i class="fas fa-edit "></i>
            </button>

			<button id="delete" data-detail="' . $data_detail . '" class="btn btn-sm btn-icon btn-danger waves-effect" title="hapus data">
                <i class="fas fa-trash"></i>
            </button>
			';

			$output['data'][] = $arr;
		}

		// $output['query'] = (string) $db->getlast_query();  
		exit(json_encode($output));

        // return $this->response->setJSON($output);
	}
}

<?php

namespace App\Controllers;

class MasterAtk extends BaseController
{
    public function index()
    {
        //query builder
        $db      = \Config\Database::connect();
        $builder = $db->table('master_atk'); 
        $query = $builder->get()->getResult();
        $data ['master_atk'] = $query;
        return view('atk/getmasteratk', $data);

        // //manual
        // $query = $this->db->query("SELECT * FROM master_atk");
        // $data['master_atk'] = $query->getResult();
        // return view('atk/getmasteratk');
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
            'id_barang_atk' => $this->request->getVar('id_barang_atk'),
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

    public function edit($id = null){
        // $db      = \Config\Database::connect();
        if($id != null){
            $query = $this->db->table('master_atk')->getWhere(['id_barang_atk'=> $id]);
            // print_r($query);
            if($query->resultID->num_rows > 0){
                $data['master_atk'] = $query->getRow();
                return view('atk/editmasteratk', $data);
            }else{
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id){
        $data = $this->request->getPost();
        unset($data['_method']);

        $this->db->table('master_atk')->where(['id_barang_atk'=> $id])->update($data);
        return redirect()->to(site_url('masteratk'))->with('success','Data Berhasil Diupdate');
    }

    public function delete($id){
        $this->db->table('master_atk')->where(['id_barang_atk'=> $id])->delete();
        return redirect()->to(site_url('masteratk'))->with('success','Data Berhasil Dihapus');
    }
}

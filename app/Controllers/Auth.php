<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        if(session('id_user')){
            return redirect()->to(site_url('/'));
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('login_user')->getWhere(['nik'=> $post['nik']]);
        $user = $query->getRow();
        // $cek = $user->password;
        // ob_start();
        // var_dump($user);

        if($user){
            if(password_verify($post['password'], $user->password)){
                $params = ['id_user' => $user->id];
                session()->set($params)
                
                ;
                // echo "lanjut proses";
                return redirect()->to(site_url('/'));
            }else{
                return redirect()->back()->with('error','Password tidak ditemukan');
            }
            // return redirect()->to(site_url('/'));
        }else{
            return redirect()->back()->with('error','NIK tidak ditemukan');
        }
    }

    public function logout(){
        session()->remove('id_user');
        return redirect()->to(site_url('login'));
    }
}
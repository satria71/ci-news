<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AtkKeluar extends BaseController
{
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
        return view ('atkkeluar/forminputatkkeluar');
    }
}

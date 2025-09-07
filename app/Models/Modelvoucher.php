<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelvoucher extends Model
{
    protected $table            = 'voucher';
    protected $primaryKey       = 'plu';
    protected $allowedFields    = [
        'plu','desc'
    ];

}

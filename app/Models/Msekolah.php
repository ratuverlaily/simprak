<?php

namespace App\Models;

use CodeIgniter\Model;

class Msekolah extends Model
{
    var $table = 'sekolah';

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('sekolah');
    }
}

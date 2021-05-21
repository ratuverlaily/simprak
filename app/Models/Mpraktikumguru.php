<?php

namespace App\Models;

use CodeIgniter\Model;

class Mpraktikumguru extends Model
{
    var $table = 'praktikum';

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('praktikum');
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Mposting extends Model
{
    var $table = 'posting_status';

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('posting_status');
    }
}

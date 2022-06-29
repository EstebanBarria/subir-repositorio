<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupsModel extends Model
{

    protected $table            = 'groups';
    protected $primaryKey       = 'id_group';
    protected $returnType       = 'object';
    protected $allowedFields    = ['name_group'];
    protected $useTimestamps = true;
}

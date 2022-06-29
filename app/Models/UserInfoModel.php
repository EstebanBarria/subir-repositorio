<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\UserInfo;

class UserInfoModel extends Model
{

    protected $table            = 'users_info';
    protected $primaryKey       = 'id_user';

    protected $returnType       = UserInfo::class;
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['name', 'surname', 'id_country'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}

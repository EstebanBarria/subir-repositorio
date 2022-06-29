<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Entities\User;
use App\Entities\UserInfo;

 class UsersModel extends Model
 {
     protected $table      = 'users';
     protected $primaryKey = 'id';

     protected $returnType     = User::class;
     protected $useSoftDeletes = true;

     protected $allowedFields = ['username', 'email', 'password', 'group'];

     protected $useTimestamps = true;
     protected $createdField  = 'created_at';
     protected $updatedField  = 'updated_at';
     protected $deletedField  = 'deleted_at';

//------------------------------------------------------------------------------

     protected $beforeInsert = ['addGroup'];
     protected $afterInsert = ['storeUserInfo'];

     protected $assignGroup;
     protected $infoUser;

     protected function storeUserInfo($data)
     {
         $this->infoUser->id_user = $data['id'];
         $model = model('UserInfoModel');
         $model->insert($this->infoUser);
     }

     //filtro para poder asignar el grupo asignado
     protected function addGroup($data)
     {
         $data['data']['group'] = $this->assignGroup;
         return $data;
     }

     //ASIGANANDO UN GRUPO AL USUARIO
     public function withGroup(string $group)
     {
         $row = $this->db->table('groups')->where('name_group',$group)->get()->getFirstRow();

         if($row !== null)
         {
             $this->assignGroup = $row->id_group;
         }
     }

     //tiene el dominio de una entidad tipo UserInfo, para insertar el registro del usuario en userinfo
     public function addInfoUser(UserInfo $ui)
     {
         $this->infoUser = $ui;
     }

     //buscar el usuario para el login
     public function getUserBy(string $column, string $value)
     {
         return $this->where($column, $value)->first();
     }
 }

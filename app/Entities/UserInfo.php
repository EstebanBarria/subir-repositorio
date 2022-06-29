<?php
namespace App\Entities;

use CodeIgniter\Entity;

    class UserInfo extends Entity
    {

        protected $dates = ['created_at', 'updated_at'];

        public function getFullName()
        {
            return $this->name . " " . $this->surname;
        }

    }

<?php
namespace App\Entities;

use CodeIgniter\Entity;
use Hashids\Hashids;

    class Category extends Entity
    {

        protected $dates = ['created_at', 'updated_at'];

        public function getEditLink()
        {
            return base_url(route_to('categories_edit', $this->id));
        }

        public function getDeleteLink()
        {
            $hash = new Hashids();
            return base_url(route_to('categories_delete', $hash->encode($this->id)));
        }
    }

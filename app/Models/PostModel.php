<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Post;

class PostModel extends Model
{
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Post::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'slug', 'body', 'cover', 'author', 'published_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $afterInsert    = ['storeCategories'];

    protected $categories = [];

    //funcion para determinar que no se suban los post antes de la fecha actual
    public function published()
    {
        $this->where('published_at <=', date('Y-m-d H:i:S'));
        return $this;
    }

    protected function storeCategories(array $data)
    {
        if(!empty($this->categories)){
            $model = model ('CategoriesPosts');
            $cats = [];
            foreach ($this->categories as $key){
                $cats[] = [
                    'id_category' => $key,
                    'id_post' => $data['id']
                ];
            }
            $model->insertBatch($cats);
        }
        return $data;
    }

    public function assignCategories(array $categories)
    {
        $this->categories = $categories;

    }

    public function getPostsByCategory(string $category)
    {
        return $this->
                select('posts.*')->
                join('categories_posts', 'posts.id = categories_posts.id_post' )->
                join('categories', 'categories.id = categories_posts.id_category')->
                where('categories.name', $category)
                ;
        
    }
}
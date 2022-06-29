<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Post extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at', 'published_at'];
    protected $casts   = [];

    protected function setSlug(string $title)
    {
        $slug = mb_url_title($title, '-');
        $model = model('PostModel');

        while($model->where('slug', $slug)->find() != null){
            $slug = increment_string($slug, '_');
        }

        $this->attributes['slug'] = $slug;
    }

    //funcion relacionar tablas para extraer nombre del autor en ves de solo su "id"
    protected function getAuthor()
    {
        if(!empty($this->attributes['author'])){
            $uimodel = model('UserInfoModel');
            return $uimodel->where('id_user', $this->attributes['author'])->first();
        }
        return $this;
    }

    //cargar las id de las categorias
    public function getCategories()
    {
        $model = model('CategoriesPosts');
        return $model->where('id_post', $this->id)->join('categories','categories.id = categories_posts.id_category')->findAll() ?? [];
    }

    //regresar la ruta de la imagen
    public function getLink()
    {
       return base_url('covers/'. $this->cover);
    }

    public function getLinkArticle()
    {
        return base_url(route_to('article', $this->slug));
    }
}

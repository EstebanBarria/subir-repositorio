<?php

namespace App\Controllers\Front;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        helper('text');
        $model = model('PostModel');
        return view('Front/Home', [
            'posts' => $model->published()->orderBy('published_at', 'desc')->paginate(8),
            'pager' => $model->pager,
        ]);
    }
    public function article($slug)
    {
        $model = model('PostModel');
        if(!$post = $model->where('slug', $slug)->first()){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        return view('Front/Article', ['post' => $post]);
    }

    public function filter(array $args)
    {
        helper('text');
        $post = model('PostModel');
        return view('Front/Filter', [
            'posts' => $post->getPostsByCategory($args['category'])->findAll($args['limit'] ?? 0)
        ]);
    }

}

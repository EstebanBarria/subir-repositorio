<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use Hashids\Hashids;

class Categories extends BaseController
{
    public function index()
    {
        $model = model('CategoriesModel');
        return view('Admin/categories', [
            'categories' => $model->orderBy('created_at','DESC')->paginate(config('Tutorial')->regPerPage),
            'pager' => $model->pager

        ]);
    }
    public function create()
    {
        return view('Admin/categoriesCreate');
    }
    public function store()
    {
        if(!$this->validate([
            'name' => 'required|max_length[120]'
        ])){
            return redirect()->back()->withInput()->with('msg',[
                'type' => 'danger',
                'body' => 'Tienes campos incorrectos'
            ])
            ->with('errors',$this->validator->getErrors());
        }

        $model = model('CategoriesModel');
        $model->save([
            'name' => trim($this->request->getVar('name'))
        ]);

        return redirect('categories')->with('msg',[
            'type' => 'success',
            'body' => 'Categoria guardada con exito'
        ]);

    }
    public function edit(string $id)
    {
        $model = model ('CategoriesModel');

        if(!$category = $model->find($id)){
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/categoriesEdit', [
            'category' => $category
        ]);
    }
    public function update()
    {
        if(!$this->validate([
            'name' => 'required|max_length[120]',
            'id' => 'required|is_not_unique[categories.id]'
        ])){
            return redirect()->back()->withInput()->with('msg',[
                'type' => 'danger',
                'body' => 'Tienes campos incorrectos'
            ])
            ->with('errors',$this->validator->getErrors());
        }

        $model = model('CategoriesModel');
        $model->save([
            'id' => trim($this->request->getVar('id')),
            'name' => trim($this->request->getVar('name'))
        ]);

        return redirect('categories')->with('msg',[
            'type' => 'success',
            'body' => 'Categoria actualizada con exito'
        ]);   
    }
    public function delete(string $id)
    {
        $hash = new Hashids();
        $id = $hash->decode($id);

        $model = model('CategoriesModel');
        $model->delete($id);

        return redirect('categories')->with('msg',[
            'type' => 'success',
            'body' => 'Categoria eliminada con exito'
        ]);  

    }
}

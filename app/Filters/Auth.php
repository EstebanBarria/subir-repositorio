<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if(!session()->is_logged){
            return redirect()->route('login')->with('msg', [
                'type' => 'danger',
                'body' => 'Para acceder, loggee su cuenta'
            ]);
        }

        $model = model('UsersModel');
        if (!$user = $model->getUserBy('id',session()->id_user))
        {
            session()->destroy();
            return redirect()->route('login')->with('msg', [
                'type' => 'danger',
                'body' => 'Usuario actualmente no disponible'
            ]);
        }

        if(!in_array($user->getRol()->name_group, $arguments))
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

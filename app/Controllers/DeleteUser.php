<?php

namespace App\Controllers;

use App\Models\UserModel;

class DeleteUser extends BaseController
{
    public function index()
    {
        $users = new UserModel();
        $session = session();
        $user = $users->where('u_email', $session->get('email'))->find();
        $id = ($user[0]['u_id']);
        $users->where('u_id', $id)->delete();
        $session->destroy();
        return redirect()->to('/');
    }
}

<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        $users = new UserModel();
        helper(['form']);
        $data = [];
        $session = \Config\Services::session();

        if ($session->has('email') && $session->has('username')) {
            $user = $users->where('u_email', $session->get('email'))->find();
            if ($user[0]['role'] === 'admin') {
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/profile');
            }
        }
        return view('login_view');
    }
    public function login()
    {
        helper(['form', 'url']);
        $session = session();
        $user = new UserModel();
        $data = [];
        $result = $user->where('u_email', $this->request->getVar('email'))->first();
        // var_dump($result);
        $getPassword = $this->request->getVar('password');
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];
        if ($this->validate($rules)) {
            if ($result) {
                $userPassword = $result['u_password'];
                if (password_verify($getPassword, $userPassword)) {
                    // session start
                    $mySession = [
                        'username' => $result['u_first_name'],
                        'email' => $result['u_email']
                    ];
                    $session->set($mySession);

                    // checking role 
                    if ($result['role'] === 'admin') {
                        return redirect()->to('/dashboard');
                    } else {
                        return redirect()->to('/profile');
                    }
                } else {
                    return view('login_view');
                }
            } else {
                return view('login_view');
            }
        } else {
            $data['validation'] = $this->validator;
            return view('login_view', $data);
        }
    }
}

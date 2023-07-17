<?php


namespace App\Controllers;

use App\Models\UserModel;


class Register extends BaseController
{
    public function index()
    {
        helper(['form']);
        $data = [];
        return view('register_view2');
    }
    public function register()
    {
        helper(['form', 'url']);
        $check = $this->validate([
            'username' => 'required|min_length[3]',
            'last_name' => 'required|min_length[3]',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'required|valid_email|is_unique[users.u_email]',
            'phone' => 'required|min_length[10]|max_length[10]|numeric',
            'password' => 'required|min_length[3]',
            'confirm_password' => 'required|matches[password]',
            'file'
            => [
                'uploaded[file]',
                'is_image[file]',
                'max_size[file,4096]',
            ],
        ]);

        if (!$check) {
            $data['validation'] = $this->validator;
            return view('register_view2', $data);
        } else {
            $user = new UserModel();
            $file = $this->request->getFile('file');
            $imageName = null;
            if ($file->isValid() && !$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move('uploads/', $imageName);
            }
            $data = [
                'u_first_name' => $this->request->getPost('username'),
                'u_last_name' => $this->request->getPost('last_name'),
                'u_dob' => $this->request->getPost('dob'),
                'u_gender' => $this->request->getPost('gender'),
                'u_email' => $this->request->getPost('email'),
                'u_phone' => $this->request->getPost('phone'),
                'u_password' => $this->request->getVar('password'),
                'image' => $imageName,
                'created_at' => date('Y-m-d H:i:s'),
                'role' => 'user'
            ];
            $user->insert($data);
            return redirect()->to('/');
        }
    }
}

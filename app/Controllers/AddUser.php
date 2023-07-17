<?php

namespace App\Controllers;

use App\Models\UserModel;

class AddUser extends BaseController
{
    public function index()
    {
        $users = new UserModel();
        $session = session();

        $user = $users->where('u_email', $session->get('email'))->find();
        if ($user[0]['role'] === 'admin') {
            return view('add_user');
        } else {
            return redirect()->to('/profile');
        }
    }
    public function addUser()
    {
        $users = new UserModel();
        $session = session();
        $name = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $check = $this->validate([
            'username' => 'required|min_length[3]',
            'last_name' => 'required|min_length[3]',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'required|valid_email|is_unique[users.u_email]',
            'phone' => 'required|min_length[10]|max_length[10]|numeric',
            'role' => 'required',
            'password' => 'required|min_length[3]',
            'confirm_password' => 'required|matches[password]'
        ]);

        if (!$check) {
            $data['validation'] = $this->validator;
            return view('add_user', $data);
        } else {
            $data = [
                'u_first_name' => $this->request->getPost('username'),
                'u_last_name' => $this->request->getPost('last_name'),
                'u_dob' => $this->request->getPost('dob'),
                'u_gender' => $this->request->getPost('gender'),
                'u_email' => $this->request->getPost('email'),
                'u_phone' => $this->request->getPost('phone'),
                'u_password' => $this->request->getVar('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'role' => $this->request->getPost('role')
            ];
            $users->insert($data);
            return redirect()->to('/dashboard');
        }
    }
    public function profile()
    {
        $data = new UserModel();
        $session = session();

        $users = $data->where('u_email', $session->get('email'))->find();
        $user = ['name' => $users];
        return view('profile_page_view', $user);
    }
    public function userEdit($id)
    {
        $session = session();
        $user = new UserModel();
        $data['users'] = $user->where('u_id', $id)->first();
        return view('user_edit', $data);
    }
    // user update
    public function userUpdate()
    {
        $user = new UserModel();
        $session = session();
        $check = $this->validate([
            'username' => 'required|min_length[3]',
            'last_name' => 'required|min_length[3]',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]|max_length[10]|numeric',
            'image' => [
                'is_image[image]',
                'max_size[image,4096]'
            ]
        ]);

        if (!$check) {
            $myUser['users'] = $user->where('u_id', $this->request->getPost('id'))->first();
            $data['validation'] = $this->validator;
            return view('user_edit', $myUser);
        }

        $id = $this->request->getPost('id');
        $userName = $this->request->getPost('username');
        $lastName = $this->request->getPost('last_name');
        $dob = $this->request->getPost('dob');
        $gender = $this->request->getPost('gender');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $file = $this->request->getFile('image');

        if ($this->request->getFile('image')) {
            $imageName = null;
            if ($file->isValid() && !$file->hasMoved()) {
                $imageName = $file->getRandomName();
                $file->move('uploads/', $imageName);
            }
            $data = [
                'u_first_name' => $userName,
                'u_last_name' => $lastName,
                'u_dob' => $dob,
                'u_gender' => $gender,
                'u_email' => $email,
                'u_phone' => $phone,
                'image' => $imageName
            ];
            $user->update($id, $data);

            return redirect()->to('/profile');
        } else {
            $data = [
                'u_first_name' => $userName,
                'u_last_name' => $lastName,
                'u_dob' => $dob,
                'u_gender' => $gender,
                'u_email' => $email,
                'u_phone' => $phone,
            ];
            $user->update($id, $data);

            return redirect()->to('/profile');
        }
    }
}

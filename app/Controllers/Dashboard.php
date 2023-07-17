<?php

namespace App\Controllers;

use App\Models\UserModel;




class Dashboard extends BaseController
{
    public function index()
    {


        $users = new UserModel();
        $session = session();

        $user = $users->where('u_email', $session->get('email'))->find();
        if ($user[0]['role'] === 'admin') {
            if ($this->request->getPost('search')) {
                $search = $this->request->getPost('search');
                $data['users'] = $users->like('u_first_name', $search)->findAll();
            } else {
                $data = [
                    'users' => $users->paginate(5),
                    'pager' => $users->pager
                ];
            }
            return view('dashboard_view', $data);
        } else {
            return redirect()->to('/profile');
        }
    }
    public function destroySession()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
    public function delete($id)
    {
        $users = new UserModel();
        $session = session();

        $user = $users->where('u_email', $session->get('email'))->find();
        if ($user[0]['role'] === 'admin') {
            $users->where('u_id', $id)->delete();
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/profile');
        }
    }
    // edit function
    public function edit($id)
    {
        $users = new UserModel();
        $session = session();
        $user = $users->where('u_email', $session->get('email'))->find();
        if ($user[0]['role'] === 'admin') {
            $data['users'] = $users->where('u_id', $id)->first();
            return view('update_view', $data);
        } else {
            return redirect()->to('/profile');
        }
    }

    // update function
    public function update()
    {
        $session = \Config\Services::session();
        $users = new UserModel();
        helper(['form', 'url']);

        $check = $this->validate([
            'username' => 'required|min_length[3]',
            'last_name' => 'required|min_length[3]',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]|max_length[10]|numeric',
            'file' => [
                'is_image[file]',
                'max_size[file,4096]'
            ]
        ]);

        if (!$check) {
            $updatedUser['users'] = $users->where('u_id', $this->request->getPost('id'))->first();
            $data['validation'] = $this->validator;
            return view('update_view', $updatedUser);
        }
        $user = $users->where('u_email', $session->get('email'))->find();
        // getPost
        $id = $this->request->getPost('id');
        $userName = $this->request->getPost('username');
        $lastName = $this->request->getPost('last_name');
        $dob = $this->request->getPost('dob');
        $gender = $this->request->getPost('gender');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $role = $this->request->getPost('role');
        $file = $this->request->getFile('file');
        //////////////////////////////////////

        if ($user[0]['role'] == 'admin') {

            if ($this->request->getFile('file')) {
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
                    'role' => $role,
                    'image' => $imageName
                ];
                $users->update($id, $data);

                return redirect()->to('/dashboard');
            } else {
                $data = [
                    'u_first_name' => $userName,
                    'u_last_name' => $lastName,
                    'u_dob' => $dob,
                    'u_gender' => $gender,
                    'u_email' => $email,
                    'u_phone' => $phone,
                    'role' => $role
                ];
                $users->update($id, $data);

                return redirect()->to('/dashboard');
            }
        } else {
            return redirect()->to('/profile');
        }
    }

    // change password
    public function changePassword($u_id)
    {
        $user = new UserModel();
        $data['users'] = $user->where('u_id', $u_id)->first();
        return view('change_password', $data);
    }
    // update
    public function updatePassword()
    {
        $user = new UserModel();
        $session = session();
        $password = $this->request->getVar('password');
        $id = $this->request->getVar('id');
        $oldPassword = $this->request->getVar('old_password');

        $data = $user->where('u_email', $session->get('email'))->find();
        if ($data[0]['role'] == 'admin') {
            $check = $this->validate([
                'password' => 'required|min_length[3]',
                'confirm_password' => 'required|matches[password]',
            ]);

            $userData['users'] = $user->where('u_id', $id)->first();
            if (!$check) {
                $data['validation'] = $this->validator;
                return view('change_password', $userData);
            }
            $data = [
                'u_password' => $password
            ];
            $user->update($id, $data);
            return redirect()->to('/dashboard');
        } else {
            $check = $this->validate([
                'old_password' => 'required',
                'password' => 'required|min_length[3]',
                'confirm_password' => 'required|matches[password]',
            ]);

            $userData['users'] = $user->where('u_id', $id)->first();
            if (!$check) {
                $data['validation'] = $this->validator;
                return view('change_password', $userData);
            }
            $pass = [
                'u_password' => $password
            ];
            if (password_verify($oldPassword, $userData['users']['u_password'])) {
                $user->update($id, $pass);
                return redirect()->to('/profile');
            }
            return view('change_password', $userData);
        }
    }
}

<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerPost()
    {
        $validation = $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        if ($userModel->insert($data)) {
            // Realiza o login automaticamente após o registro
            $user = $userModel->where('email', $data['email'])->first();
            session()->set([
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_email' => $user['email'],
                'logged_in' => true,
            ]);

            return redirect()->to('/posts')->with('success', 'Registro realizado com sucesso!');
        }

        return redirect()->back()->withInput()->with('errors', $userModel->errors());
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginPost()
    {
        $validation = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_email' => $user['email'],
                'logged_in' => true,
            ]);

            return redirect()->to('/posts')->with('success', 'Login realizado com sucesso!');
        }

        return redirect()->back()->withInput()->with('error', 'Credenciais erradas.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Você saiu com sucesso.');
    }
}

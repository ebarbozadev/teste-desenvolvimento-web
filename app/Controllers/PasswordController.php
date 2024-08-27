<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class PasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function sendResetLink()
    {
        $email = $this->request->getPost('email');

        // Verifica se o usuário existe
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'E-mail não encontrado.');
        }

        // Gera um token de redefinição e define o tempo de expiração
        $token = bin2hex(random_bytes(50));
        $expiry = Time::now()->addHours(1); // O token expira em 1 hora

        // Atualiza o usuário com o token e o tempo de expiração
        $data = [
            'reset_token' => $token,
            'reset_token_expiry' => $expiry
        ];

        if (!$userModel->update($user['id'], $data)) {
            return redirect()->back()->with('error', 'Não foi possível gerar o link de redefinição de senha.');
        }

        // Redireciona para a página de redefinição de senha
        return redirect()->to('/reset-password/' . $token)->with('success', 'Por favor, redefina sua senha.');
    }

    public function resetPassword($token)
    {
        // Verifica se o token é válido
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)
            ->where('reset_token_expiry >=', Time::now())
            ->first();

        if (!$user) {
            return redirect()->to('/forgot-password')->with('error', 'Token inválido ou expirado.');
        }

        return view('auth/reset_password', ['token' => $token]);
    }

    public function updatePassword()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($password !== $confirmPassword) {
            return redirect()->back()->with('error', 'As senhas não coincidem.');
        }

        // Verifica se o token é válido
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)
            ->where('reset_token_expiry >=', Time::now())
            ->first();

        if (!$user) {
            return redirect()->to('/forgot-password')->with('error', 'Token inválido ou expirado.');
        }

        // Atualiza a senha e limpa o token de redefinição
        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_token_expiry' => null
        ];

        if (!$userModel->update($user['id'], $data)) {
            return redirect()->back()->with('error', 'Não foi possível redefinir a senha.');
        }

        return redirect()->to('/login')->with('success', 'Senha redefinida com sucesso. Faça login com sua nova senha.');
    }
}

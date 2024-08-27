<?php

namespace App\Controllers;

use App\Models\PostModel;
use CodeIgniter\Controller;

class PostController extends Controller
{
    public function index()
    {
        $postModel = new PostModel();
        $data['posts'] = $postModel->where('author', session()->get('user_id'))->findAll();

        return view('posts/index', $data);
    }

    public function create()
    {
        return view('posts/create');
    }

    public function store()
    {
        $postModel = new PostModel();

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'img_url'     => $this->request->getPost('img_url'),
            'author'      => session()->get('user_id'),
        ];

        $postModel->insert($data);
        return redirect()->to('/posts')->with('success', 'Publicação criada com sucesso!');
    }

    public function edit($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);

        if ($post['author'] != session()->get('user_id')) {
            return redirect()->to('/posts')->with('error', 'Você não tem permissão para editar esta publicação.');
        }

        $data['post'] = $post;
        return view('posts/edit', $data);
    }

    public function update($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);

        if ($post['author'] != session()->get('user_id')) {
            return redirect()->to('/posts')->with('error', 'Você não tem permissão para editar esta publicação.');
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'img_url'     => $this->request->getPost('img_url'),
        ];

        $postModel->update($id, $data);
        return redirect()->to('/posts')->with('success', 'Publicação atualizada com sucesso!');
    }

    public function delete($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);

        if ($post['author'] != session()->get('user_id')) {
            return redirect()->to('/posts')->with('error', 'Você não tem permissão para excluir esta publicação.');
        }

        $postModel->delete($id);
        return redirect()->to('/posts')->with('success', 'Publicação excluída com sucesso!');
    }
}

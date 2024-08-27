<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Publicações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Minhas Publicações</h2>
        <a href="<?= base_url('/logout') ?>" class="btn btn-danger">Sair</a>
        <a href="<?= base_url('/post/create') ?>" class="btn btn-primary mb-3">Criar Nova Publicação</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($posts) > 0): ?>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['description'] ?></td>
                            <td>
                                <a href="<?= base_url('/post/edit/' . $post['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="<?= base_url('/post/delete/' . $post['id']) ?>" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Você ainda não tem publicações.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
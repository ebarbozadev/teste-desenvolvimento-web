<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Publicação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Editar Publicação</h2>
        <form action="<?= base_url('/post/update/' . $post['id']) ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?= $post['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="img_url" class="form-label">URL da Imagem</label>
                <input type="text" class="form-control" id="img_url" name="img_url" value="<?= $post['img_url'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Publicação</button>
            <a href="<?= base_url('/posts') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>
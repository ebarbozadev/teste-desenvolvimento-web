<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <?php if (session()->get('logged_in')): ?>
            <div class="d-flex justify-content-end">
                <a href="<?= base_url('/sair') ?>" class="btn btn-danger">Sair</a>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>
</body>

</html>
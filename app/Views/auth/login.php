<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Login</h2>

        <?php if (session()->get('error')): ?>
            <script>
                alert('Usuário ou Senha incorreto');
            </script>
        <?php endif; ?>

        <form action="<?= base_url('/login') ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?= old('email') ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mt-3 text-center">
                <button type="submit" class="btn btn-primary">Entrar</button>
                <a href="<?= base_url('/register') ?>">Registrar</a> |
                <a href="<?= base_url('/forgot-password') ?>">Esqueci a senha</a>
            </div>
        </form>


    </div>
</body>

</html>
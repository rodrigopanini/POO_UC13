<?php
require_once __DIR__ . "/../../db/auth.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["usuario"]);
    $password = trim($_POST["senha"]);

    $auth = new Auth();
    if ($auth->login($email, $password)) {
        header("Location: /poo");
        exit;
    } else {
        $error = "Usuário ou senha inválidos.";
    }
} else {
    session_unset(); 
}
?>

<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h3 class="text-center mb-4">Acesso ao Sistema</h3>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="post" action="index.php?page=login">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário (e-mail):</label>
                        <input type="email" name="usuario" id="usuario" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" name="senha" id="senha" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

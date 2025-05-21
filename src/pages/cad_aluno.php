<?php
require __DIR__ . "/../classes/Aluno.php";

// Inicializa as variáveis
$nome = $nascimento = $cpf = "";
$alunoCriado = false;

//Cadastrando
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $nascimento = trim($_POST["nascimento"]);
    $cpf = trim($_POST["cpf"]);
    try {
        $aluno = new Aluno($nome, $nascimento, $cpf);
        $alunoCriado = $aluno->cadastrar();
        if ($alunoCriado === true) {
            echo "<div class='alert alert-success mt-3'>Aluno cadastrado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Erro ao cadastrar aluno.</div>";
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger mt-3'>" . $e->getMessage() . "</div>";
    }
}
$alunos = Aluno::listar();
?>

<h2>Cadastro de Aluno</h2>

<form method="post" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" name="nome" id="nome" class="form-control"
            value="<?= htmlspecialchars($nome) ?>">
    </div>

    <div class="col-md-2">
        <label for="cpf" class="form-label">CPF:</label>
        <input type="text" name="cpf" id="cpf" class="form-control"
            value="<?= htmlspecialchars($cpf) ?>">
    </div>

    <div class="col-md-2">
        <label for="nascimento" class="form-label">Data de Nascimento:</label>
        <input type="date" name="nascimento" id="nascimento" class="form-control"
            value="<?= htmlspecialchars($nascimento) ?>">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<h3>Lista de Alunos</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Data de Nascimento</th>
        </tr>
    </thead>
    <tbody>
       <?php if ($alunos && count($alunos) > 0): ?>
            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars($aluno['nome']) ?></td>
                    <td><?= htmlspecialchars($aluno['cpf']) ?></td>
                    <td><?= htmlspecialchars($aluno['nascimento']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">Nenhum aluno cadastrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php
require __DIR__ . "/../classes/curso.php";

// Inicializa as variáveis
$titulo = $hora = $dia = $aluno = "";
$cursoCriado = false;

//Cadastrando
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST["titulo"]);
    $hora = trim($_POST["hora"]);
    $dia = trim($_POST["dia"]);
    $aluno = trim($_POST["aluno"]);
    try {
        $curso = new Curso($titulo, $hora, $dia, $aluno);
        $cursoCriado = true;
    } catch (Exception $e) {
        echo "<div class='alert alert-danger mt-3'>" . $e->getMessage() . "</div>";
    }
}
?>

<h2>Cadastro de Curso</h2>

<form method="post" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="titulo" class="form-label">Titulo:</label>
        <input type="text" name="titulo" id="titulo" class="form-control"
            value="<?= htmlspecialchars($titulo) ?>">
    </div>

    <div class="col-md-2">
        <label for="dia" class="form-label">Dias de Curso:</label>
        <input type="text" name="dia" id="dia" class="form-control"
            value="<?= htmlspecialchars($dia) ?>">
    </div>

    <div class="col-md-2">
        <label for="hora" class="form-label">Quantidade de Horas:</label>
        <input type="number" name="hora" id="hora" class="form-control"
            value="<?= htmlspecialchars($hora) ?>">
    </div>

    <div class="col-md-4">
        <label for="aluno" class="form-label">Aluno:</label>
        <input type="text" name="aluno" id="aluno" class="form-control"
            value="<?= htmlspecialchars($aluno) ?>">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<?php
if ($cursoCriado) {
    echo "<h3>Resultado:</h3>";
    $curso->exibirDados();
}
?>
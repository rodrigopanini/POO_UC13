<?php

require_once "db/db.php";

class Aluno {
    public $nome;
    public $nascimento;
    private $cpf;

    // Construtor com validação
    public function __construct($nome, $nascimento, $cpf) {
        if (empty($nome)) {
            throw new Exception("O campo Nome é obrigatório.");
        }
        if (empty($cpf)) {
            throw new Exception("O campo CPF é obrigatório.");
        }
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->cpf = $cpf;
    }

    // Getter do CPF (encapsulamento)
    public function getCpf() {
        return $this->cpf;
    }

    // Método para exibir os dados
    public function exibirDados() {
        echo "<p>Nome: <strong>$this->nome</strong><br>";
        echo "Nascimento: <strong>$this->nascimento</strong><br>";
        echo "CPF: <strong>" . $this->getCpf() . "</strong></p>";
    }

    // Método para cadastrar o aluno no banco de dados
    public function cadastrar() {
        // Conexão com o banco de dados
        $database = new Database();
        $conn = $database->getConnection();

        // Preparar a consulta SQL
        $query = "INSERT INTO aluno (nome, nascimento, cpf) VALUES (:nome, :nascimento, :cpf)";
        $stmt = $conn->prepare($query);

        // Bind dos parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':nascimento', $this->nascimento);
        $stmt->bindParam(':cpf', $this->cpf);

        // Executar a consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Método para listar os alunos
    public static function listar() {
        // Conexão com o banco de dados
        $database = new Database();
        $conn = $database->getConnection();

        // Preparar a consulta SQL
        $query = "SELECT * FROM aluno";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Retornar os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

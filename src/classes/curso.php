<?php

class Curso {
    public $titulo;
    public $hora;
    public $dia;
    private $aluno;

    // Construtor com validação
    public function __construct($titulo, $hora, $dia, $aluno) {
        if (empty($titulo)) {
            throw new Exception("O campo Título é obrigatório.");
        }
        if (!filter_var($hora, FILTER_VALIDATE_INT) || $hora < 0) {
            throw new Exception("A Hora deve ser um número inteiro positivo.");
        }
        if (empty($aluno)) {
            throw new Exception("O campo Aluno é obrigatório.");
        }
        $this->titulo = $titulo;
        $this->hora = $hora;
        $this->dia = $dia;
        $this->aluno = $aluno;
    }

    // Getter do Aluno (encapsulamento)
    public function getAluno() {
        return $this->aluno;
    }

    // Método para exibir os dados
    public function exibirDados() {
        echo "<p>Título do Curso: <strong>$this->titulo</strong><br>";
        echo "Horas de Curso: <strong>$this->hora</strong><br>";
        echo "Dia da Semana: <strong>$this->dia</strong><br>";
        echo "Dia da Semana: <strong>" . $this->getAluno() . "</strong></p>";
    }
}

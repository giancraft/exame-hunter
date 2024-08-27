<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class PDOCandidatoDAO
{
    private static $instance = NULL;
    private $conn = NULL;

    function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=exame_hunter';
        $user = 'gian';
        $password = '1234';

        try {
            $this->conn = new PDO($dsn, $user, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erro ao conectar ao MySQL: ' . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$instance == NULL)
            self::$instance = new PDOCandidatoDAO();        
        return self::$instance;
    }

    public function insert($nome, $peso, $altura, $dataNascimento) {
        $sql = 'INSERT INTO candidato (nome, peso, altura, dataNascimento) VALUES (:nome, :peso, :altura, :dataNascimento)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':altura', $altura);
        $stmt->bindParam(':dataNascimento', $dataNascimento);
        return $stmt->execute();
    }

    public function getAll() {
        $sql = 'SELECT * FROM candidato';
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE candidato SET nome=:nome, peso=:peso, altura=:altura, dataNascimento=:dataNascimento WHERE id=:id');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':peso' => $objeto->peso,
                    ':altura' => $objeto->altura,
                    ':dataNascimento' => $objeto->dataNascimento,
                    ':id' => $objeto->id
                )
            );
            print $stmt->rowCount();
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }
    }

    public function excluir($id)
    {
        try {      
            $stmt = $this->conn->prepare('DELETE FROM candidato WHERE id=:id');
            $stmt->execute(
                array(
                    ':id' => $id
                )
            );
            print $stmt->rowCount();
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
        }
    }

    public function listar()
    {
        $dados = array();
        try {
            $result = $this->conn->query("SELECT * FROM candidato");

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $candidato = array();
                $candidato['id'] = $linha['id'];
                $candidato['nome'] = $linha['nome'];
                $candidato['peso'] = $linha['peso'];
                $candidato['altura'] = $linha['altura'];
                $candidato['dataNascimento'] = $linha['dataNascimento'];
                array_push($dados, $candidato);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;
    }

    public function listarFiltro($nomeFiltro = '') {
        $sql = "SELECT * FROM candidato";
        if (!empty($nomeFiltro)) {
            $sql .= " WHERE nome LIKE :nomeFiltro";
        }

        $stmt = $this->conn->prepare($sql);

        if (!empty($nomeFiltro)) {
            $stmt->bindValue(':nomeFiltro', '%' . $nomeFiltro . '%');
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_filtro($filtro)
    {
        $dados = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM candidato WHERE $filtro");
            $stmt->execute();
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $candidato = array();
                $candidato['id'] = $linha['id'];
                $candidato['nome'] = $linha['nome'];
                $candidato['peso'] = $linha['peso'];
                $candidato['altura'] = $linha['altura'];
                $candidato['dataNascimento'] = $linha['dataNascimento'];
                array_push($dados, $candidato);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;
    }

    public function obter($id)
    {
        $candidato = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM candidato WHERE id = ?");
            $stmt->execute([$id]);
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $candidato['id'] = $linha['id'];
                $candidato['nome'] = $linha['nome'];
                $candidato['peso'] = $linha['peso'];
                $candidato['altura'] = $linha['altura'];
                $candidato['dataNascimento'] = $linha['dataNascimento'];
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $candidato;
    }

}
?>
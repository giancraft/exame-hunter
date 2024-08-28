<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class PDOExaminadorDAO
{
    private static $instance = NULL;
    private $conn = NULL;

    function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=exame_hunter';
        $user = 'root';
        $password = '';

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
            self::$instance = new PDOExaminadorDAO();        
        return self::$instance;
    }

    public function insert($nome, $peso, $altura, $dataNascimento) {
        $sql = 'INSERT INTO examinador (nome, peso, altura, dataNascimento) VALUES (:nome, :peso, :altura, :dataNascimento)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':altura', $altura);
        $stmt->bindParam(':dataNascimento', $dataNascimento);
        return $stmt->execute();
    }

    public function getAll() {
        $sql = 'SELECT * FROM examinador';
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE examinador SET nome=:nome, peso=:peso, altura=:altura, dataNascimento=:dataNascimento WHERE id=:id');
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
            $stmt = $this->conn->prepare('DELETE FROM examinador WHERE id=:id');
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
            $result = $this->conn->query("SELECT * FROM examinador");

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $examinador = array();
                $examinador['id'] = $linha['id'];
                $examinador['nome'] = $linha['nome'];
                $examinador['peso'] = $linha['peso'];
                $examinador['altura'] = $linha['altura'];
                $examinador['dataNascimento'] = $linha['dataNascimento'];
                array_push($dados, $examinador);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;
    }

    public function listarFiltro($nome = '', $tipoNen_id = null) {
        $query = "SELECT e.* FROM examinador e";
        $params = array();
    
        if ($tipoNen_id) {
            $query .= " INNER JOIN examinador_tipoNen etn ON e.id = etn.examinador_id WHERE etn.tipoNen_id = :tipoNen_id";
            $params[':tipoNen_id'] = $tipoNen_id;
        } else {
            $query .= " WHERE 1=1";
        }
    
        if (!empty($nome)) {
            $query .= " AND e.nome LIKE :nome";
            $params[':nome'] = '%' . $nome . '%';
        }
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function obter($id)
    {
        $examinador = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM examinador WHERE id = ?");
            $stmt->execute([$id]);
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $examinador['id'] = $linha['id'];
                $examinador['nome'] = $linha['nome'];
                $examinador['peso'] = $linha['peso'];
                $examinador['altura'] = $linha['altura'];
                $examinador['dataNascimento'] = $linha['dataNascimento'];
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $examinador;
    }

}
?>
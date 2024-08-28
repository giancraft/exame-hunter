<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class PDOAdministradorDAO
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
            self::$instance = new PDOAdministradorDAO();        
        return self::$instance;
    }

    public function insert($nome, $email, $senha) {
        $sql = 'INSERT INTO administrador (nome, email, senha) VALUES (:nome, :email, :senha)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        return $stmt->execute();
    }

    public function getAll() {
        $sql = 'SELECT * FROM administrador';
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE administrador SET nome=:nome, email=:email, senha=:senha WHERE id=:id');
            $stmt->execute(
                array(
                    ':nome' => $objeto->nome,
                    ':email' => $objeto->email,
                    ':senha' => $objeto->senha,
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
            $stmt = $this->conn->prepare('DELETE FROM administrador WHERE id=:id');
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
            $result = $this->conn->query("SELECT * FROM administrador");

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $administrador = array();
                $administrador['id'] = $linha['id'];
                $administrador['nome'] = $linha['nome'];
                $administrador['email'] = $linha['email'];
                $administrador['senha'] = $linha['senha'];
                array_push($dados, $administrador);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;
    }

    public function listar_filtro($filtro)
    {
        $dados = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM administrador WHERE $filtro");
            $stmt->execute();
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $administrador = array();
                $administrador['id'] = $linha['id'];
                $administrador['nome'] = $linha['nome'];
                $administrador['email'] = $linha['email'];
                $administrador['senha'] = $linha['senha'];
                array_push($dados, $administrador);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;
    }

    public function obter($id)
    {
        $administrador = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM administrador WHERE id = ?");
            $stmt->execute([$id]);
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $administrador['id'] = $linha['id'];
                $administrador['nome'] = $linha['nome'];
                $administrador['email'] = $linha['email'];
                $administrador['senha'] = $linha['senha'];
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $administrador;
    }

}
?>
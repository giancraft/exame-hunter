<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class PDOContatoDAO
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
            self::$instance = new PDOContatoDAO();        
        return self::$instance;
    }

    public function insert($email, $descricao) {
        $sql = 'INSERT INTO contato (email, descricao) VALUES (:email, :descricao)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function getAll() {
        $sql = 'SELECT * FROM contato';
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE contato SET email=:email, descricao=:descricao WHERE id=:id');
            $stmt->execute(
                array(
                    ':email' => $objeto->email,
                    ':descricao' => $objeto->descricao,
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
            $stmt = $this->conn->prepare('DELETE FROM contato WHERE id=:id');
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
            $result = $this->conn->query("SELECT * FROM contato");

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $contato = array();
                $contato['id'] = $linha['id'];
                $contato['email'] = $linha['email'];
                $contato['descricao'] = $linha['descricao'];
                array_push($dados, $contato);
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
            $stmt = $this->conn->prepare("SELECT * FROM contato WHERE $filtro");
            $stmt->execute();
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contato = array();
                $contato['id'] = $linha['id'];
                $contato['email'] = $linha['email'];
                $contato['descricao'] = $linha['descricao'];
                array_push($dados, $contato);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;
    }

    public function obter($id)
    {
        $contato = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM contato WHERE id = ?");
            $stmt->execute([$id]);
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contato['id'] = $linha['id'];
                $contato['email'] = $linha['email'];
                $contato['descricao'] = $linha['descricao'];
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $contato;
    }

}
?>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class PDOTipoNenDAO
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
            self::$instance = new PDOTipoNenDAO();        
        return self::$instance;
    }

    public function insert($descricao) {
        $sql = 'INSERT INTO tipoNen (descricao) VALUES (:descricao)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function getAll() {
        $sql = 'SELECT * FROM tipoNen';
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function alterar($objeto)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE tipoNen SET descricao=:descricao WHERE id=:id');
            $stmt->execute(
                array(
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
            $stmt = $this->conn->prepare('DELETE FROM tipoNen WHERE id=:id');
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
            $result = $this->conn->query("SELECT * FROM tipoNen");

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $tipoNen = array();
                $tipoNen['id'] = $linha['id'];
                $tipoNen['descricao'] = $linha['descricao'];
                array_push($dados, $tipoNen);
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
            $stmt = $this->conn->prepare("SELECT * FROM tipoNen WHERE $filtro");
            $stmt->execute();
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $tipoNen = array();
                $tipoNen['id'] = $linha['id'];
                $tipoNen['descricao'] = $linha['descricao'];
                array_push($dados, $tipoNen);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;
    }

    public function obter($id)
    {
        $tipoNen = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tipoNen WHERE id = ?");
            $stmt->execute([$id]);
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $tipoNen['id'] = $linha['id'];
                $tipoNen['descricao'] = $linha['descricao'];
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $tipoNen;
    }

}
?>
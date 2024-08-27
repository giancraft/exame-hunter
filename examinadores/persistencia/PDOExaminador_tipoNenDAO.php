<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "Examinador_TipoNen.php";
class PDOExaminador_tipoNenDAO
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
            self::$instance = new PDOExaminador_tipoNenDAO();        
        return self::$instance;
    }

    public function insert($examinador_id, $tipoNen_id) {
        $sql = 'INSERT INTO examinador_tipoNen (examinador_id, tipoNen_id) VALUES (:examinador_id, :tipoNen_id)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':examinador_id', $examinador_id);
        $stmt->bindParam(':tipoNen_id', $tipoNen_id);
        return $stmt->execute();
    }

    public function getAll() {
        $sql = 'SELECT * FROM examinador_tipoNen';
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir($examinadorId, $tipoNenId)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM examinador_tipoNen WHERE examinador_id = :examinador_id AND tipoNen_id = :tipoNen_id");
            $stmt->bindParam(':examinador_id', $examinadorId, PDO::PARAM_INT);
            $stmt->bindParam(':tipoNen_id', $tipoNenId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao excluir associação Examinador-TipoNen: " . $e->getMessage());
        }
    }

    public function excluirPorExaminador($examinadorId)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM examinador_tipoNen WHERE examinador_id = :examinador_id");
            $stmt->bindParam(':examinador_id', $examinadorId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao excluir associações Examinador-TipoNen: " . $e->getMessage());
        }
    }



    public function listar()
    {
        $dados = array();
        try {
            $result = $this->conn->query("SELECT * FROM examinador_tipoNen");

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $examinador_tipoNen = array();
                $examinador_tipoNen['id'] = $linha['id'];
                $examinador_tipoNen['examinador_id'] = $linha['examinador_id'];
                $examinador_tipoNen['tipoNen_id'] = $linha['tipoNen_id'];
                array_push($dados, $examinador_tipoNen);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;
    }

    public function listarPorExaminador($examinadorId)
{
    try {
        $stmt = $this->conn->prepare("SELECT * FROM examinador_tipoNen WHERE examinador_id = :examinador_id");
        $stmt->bindParam(':examinador_id', $examinadorId, PDO::PARAM_INT);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lista = array();
        foreach ($resultados as $linha) {
            $examinadorTipoNen = new Examinador_TipoNen();
            $examinadorTipoNen->examinador_id = $linha['examinador_id'];
            $examinadorTipoNen->tipoNen_id = $linha['tipoNen_id'];
            $lista[] = $examinadorTipoNen;
        }

        return $lista;
    } catch (PDOException $e) {
        throw new Exception("Erro ao listar tipos de Nen por Examinador: " . $e->getMessage());
    }
}


    public function listar_filtro($filtro)
    {
        $dados = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM examinador_tipoNen WHERE $filtro");
            $stmt->execute();
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $examinador_tipoNen = array();
                $examinador_tipoNen['id'] = $linha['id'];
                $examinador_tipoNen['examinador_id'] = $linha['examinador_id'];
                $examinador_tipoNen['tipoNen_id'] = $linha['tipoNen_id'];
                array_push($dados, $examinador_tipoNen);
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $dados;
    }

    public function obter($id)
    {
        $examinador_tipoNen = array();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM examinador_tipoNen WHERE id = ?");
            $stmt->execute([$id]);
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $examinador_tipoNen['id'] = $linha['id'];
                $examinador_tipoNen['examinador_id'] = $linha['examinador_id'];
                $examinador_tipoNen['tipoNen_id'] = $linha['tipoNen_id'];
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $examinador_tipoNen;
    }

}
?>
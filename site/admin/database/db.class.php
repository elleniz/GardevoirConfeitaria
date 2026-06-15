<?php

class db
{

    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $port = '3306';
    private $dbname = 'confeitaria';
    private $table_name;
    private $conn;

    public function __construct($table_name)
    {
        $this->table_name = $table_name;
        $this->conn = $this->connect();
    }

    // Método privado: apenas a própria classe pode chamar
    private function connect()
    {
        try {
            return new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port;charset=utf8",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (PDOException $e) {
            die('Erro na conexão: ' . $e->getMessage());
        }
    }

    // SELECT * FROM tabela
    public function all()
    {
        $sql = "SELECT * FROM $this->table_name";
        $st = $this->conn->prepare($sql);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    // SELECT * FROM tabela WHERE id = ?
    public function find($id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE id = ?";
        $st = $this->conn->prepare($sql);
        $st->execute([$id]);

        return $st->fetchObject();
    }

    // SELECT * FROM tabela WHERE campo = valor
    public function findBy($campo, $valor)
    {
        $sql = "SELECT * FROM $this->table_name WHERE $campo = ?";
        $st = $this->conn->prepare($sql);
        $st->execute([$valor]);

        return $st->fetchObject();
    }

    //INSERT INTO tabela ('campo1', 'campo2') VALUES (?, ?);
    public function store($dados)
    {
        $campos = "";
        $marcadores = "";
        $vetorData = [];
        $sep = "";

        foreach ($dados as $campo => $valor) {
            $campos .= $sep . $campo;
            $marcadores .= $sep . "?";
            $vetorData[] = $valor;
            $sep = ",";
        }

        $sql = "INSERT INTO $this->table_name ($campos) VALUES ($marcadores);";

        try {
            $st = $this->conn->prepare($sql);
            $st->execute($vetorData);
        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir: " . $e->getMessage());
        }
    }

    // UPDATE
    public function update($dados)
    {
        $campos = "";
        $vetorData = [];
        $sep = "";

        foreach ($dados as $campo => $valor) {
            if ($campo !== 'id') {
                $campos .= $sep . "$campo = ?";
                $vetorData[] = $valor;
                $sep = ", ";
            }
        }

        $vetorData[] = $dados['id'];

        $sql = "UPDATE $this->table_name SET $campos WHERE id = ?;";

        try {
            $st = $this->conn->prepare($sql);
            $st->execute($vetorData);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar: " . $e->getMessage());
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {

            $sql = "DELETE FROM $this->table_name WHERE id = ?;";
            $st = $this->conn->prepare($sql);
            $st->execute([$id]);

        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar: " . $e->getMessage());
        }
    }

    //SELECT * FROM tabela WHERE campo like '%valor%'
    public function search($dados)
    {
        $campo = $dados['tipo'];
        $valor = $dados['valor'];

        $sql = "SELECT * FROM $this->table_name WHERE $campo LIKE ?";

        try {

            $st = $this->conn->prepare($sql);
            $st->execute(["%$valor%"]);

            return $st->fetchAll(PDO::FETCH_CLASS);

        } catch (PDOException $e) {
            throw new Exception("Erro ao pesquisar: " . $e->getMessage());
        }
    }
}
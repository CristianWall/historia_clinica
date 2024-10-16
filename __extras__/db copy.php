<?php
class Database
{
    private $host = "localhost";
    private $db_name = "historiaclinica";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}

class Persona
{
    private $conn;
    private $table_name = "personas";

    public $dni;
    public $nombres;
    public $apellidopa;
    public $apellidoma;
    public $nombrepa;
    public $nombrema;
    public $nacionalidad;
    public $sexo;
    public $fechanac;
    public $lugarnac;
    public $lugarresi;
    public $direccion;
    public $gradoins;
    public $estadoci;
    public $ocupacion;
    public $religion;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read($search = "", $start = 0, $limit = 10)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE CONCAT(dni, ' ', nombres, ' ', apellidopa, ' ', apellidoma, ' ', nombrepa, ' ', nombrema, ' ', nacionalidad, ' ', sexo, ' ', fechanac, ' ', lugarnac, ' ', lugarresi, ' ', direccion, ' ', gradoins, ' ', estadoci, ' ', ocupacion, ' ', religion) LIKE ? LIMIT ?, ?";
        $stmt = $this->conn->prepare($query);
        $search = "%{$search}%";
        $stmt->bind_param("sii", $search, $start, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET dni=?, nombres=?, apellidopa=?, apellidoma=?, nombrepa=?, nombrema=?, nacionalidad=?, sexo=?, fechanac=?, lugarnac=?, lugarresi=?, direccion=?, gradoins=?, estadoci=?, ocupacion=?, religion=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssssssssssss", $this->dni, $this->nombres, $this->apellidopa, $this->apellidoma, $this->nombrepa, $this->nombrema, $this->nacionalidad, $this->sexo, $this->fechanac, $this->lugarnac, $this->lugarresi, $this->direccion, $this->gradoins, $this->estadoci, $this->ocupacion, $this->religion);
        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET nombres=?, apellidopa=?, apellidoma=?, nombrepa=?, nombrema=?, nacionalidad=?, sexo=?, fechanac=?, lugarnac=?, lugarresi=?, direccion=?, gradoins=?, estadoci=?, ocupacion=?, religion=? WHERE dni=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssssssssssss", $this->nombres, $this->apellidopa, $this->apellidoma, $this->nombrepa, $this->nombrema, $this->nacionalidad, $this->sexo, $this->fechanac, $this->lugarnac, $this->lugarresi, $this->direccion, $this->gradoins, $this->estadoci, $this->ocupacion, $this->religion, $this->dni);
        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE dni=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->dni);
        return $stmt->execute();
    }

    public function count()
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}

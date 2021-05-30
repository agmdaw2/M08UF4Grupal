<?php
session_start();

// Creamos 2 objetos, para el juego de adivinar nosotros y el de adivinar la Maquina
class Num {
    public $num_m;
    public $cont_gen = 0;
    public $acer = false;

    function getNum_m() {
        return $this->num_m;
    }

    function getCont_gen() {
        return $this->cont_gen;
    }

    function getAcer() {
        return $this->acer;
    }

    function setNum_m($num_m) {
        $this->num_m = $num_m;
    }

    function setCont_gen($cont_gen) {
        $this->cont_gen = $cont_gen;
    }

    function setAcer($acer) {
        $this->acer = $acer;
    }
}

class Maq {
    public $cont = 0;
    public $piv_i = 0;
    public $piv_d = 0;
    public $num_maq;
    
    function getCont() {
        return $this->cont;
    }

    function getPiv_i() {
        return $this->piv_i;
    }

    function getPiv_d() {
        return $this->piv_d;
    }

    function getNum_maq() {
        return $this->num_maq;
    }

    function setCont($cont) {
        $this->cont = $cont;
    }

    function setPiv_i($piv_i) {
        $this->piv_i = $piv_i;
    }

    function setPiv_d($piv_d) {
        $this->piv_d = $piv_d;
    }

    function setNum_maq($num_maq) {
        $this->num_maq = $num_maq;
    }
}

// CONEXION PROCEDIMENTAL
class databaseProc {
    public function __construct($servername, $username, $password, $db) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
    }

    public function connect(): void {
        $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->db);
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
            $this->connection = null;
        }
    }

    public function insert($modalitat, $nivell, $intents): int {
        $sql = "INSERT INTO estadistiques (modalitat, nivell, intents) VALUES ('$modalitat', $nivell, $intents)";
        if ($this->connection != null) {
            if (mysqli_query($this->connection, $sql)) {
                return mysqli_insert_id($this->connection);
            } else {
                return -1;
            }
        }
    }

    public function selectAll() {
        $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques";
        $result = null;
        if ($this->connection != null) {
            $result = mysqli_query($this->connection, $sql);
        }
        return $result;        
    }

    public function selectAllNivellModalitat($modalitat, $nivell) {
        $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE modalitat = '$modalitat' AND nivell = '$nivell'";
        $result = null;
        if ($this->connection != null) {
            $result = mysqli_query($this->connection, $sql);
        }
        return $result;        
    }

    public function totalVictorias($modalitat, $nivell){
        $sql = "SELECT COUNT(id) FROM estadistiques WHERE modalitat = '$modalitat' AND nivell = '$nivell'";
        $result = null;
        if ($this->connection != null) {
            $result = mysqli_query($this->connection, $sql);
        }
        return $result; 
    }

    public function selectByModalitat($modalitat) {
        $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE modalitat = '$modalitat'";
        $result = null;
        if ($this->connection != null) {
            $result = mysqli_query($this->connection, $sql);
        }
        return $result; 
    }
}

?>
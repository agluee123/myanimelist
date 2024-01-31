<?php

class AccesoDatos {
    private $conexion;
    private $comando;
    private $lector;

    public function getLector()
    {
        return $this->lector;
    }



    public function __construct() {
        $this->conexion = new mysqli("localhost", "root", "", "myanime");

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

        $this->comando = new mysqli_stmt($this->conexion);
    }

    public function setearConsulta($consulta) {
        $this->comando = $this->conexion->prepare($consulta);
    }

    public function ejecutarLectura() {
        try {
            $this->comando->execute();
            $this->lector = $this->comando->get_result();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function ejecutarAccion() {
        try {
            $this->comando->execute();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function setearParametro($nombre, $valor) {
        $this->comando->bind_param($nombre, $valor);
    }

    public function cerrarConexion() {
        if ($this->lector != null) {
            $this->lector->close();
        }
        $this->comando->close();
        $this->conexion->close();
    }
}
?>

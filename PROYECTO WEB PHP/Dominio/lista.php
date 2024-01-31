<?php
class Autor
{
    private $id_lista;
    private $nombre;
    private $id_usuario;



    public function getIdLista()
    {
        return $this->id_lista;
    }

    public function setIdLista($id_lista)
    {
        $this->id_lista = $id_lista;
    }

    // Métodos getter y setter para $nombre
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setNombreAutor($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }



}

?>
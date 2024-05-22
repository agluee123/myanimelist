<?php
class Autor
{
    private $id_autor;
    private $nombre_autor;



    public function getIdAutor()
    {
        return $this->id_autor;
    }

    public function setIdAutor($id_autor)
    {
        $this->id_autor = $id_autor;
    }

    // Métodos getter y setter para $nombre
    public function getNombreAutor()
    {
        return $this->nombre_autor;
    }

    public function setNombreAutor($nombre_autor)
    {
        $this->nombre_autor = $nombre_autor;
    }
}

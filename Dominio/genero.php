<?php
class Genero
{
    private $id_genero;
    private $nombre_genero;



    public function getIdGenero()
    {
        return $this->id_genero;
    }

    public function setIdGenero($id_genero)
    {
        $this->id_genero = $id_genero;
    }

    // Métodos getter y setter para $nombre
    public function getNombreGenero()
    {
        return $this->nombre_genero;
    }

    public function setNombreGenero($nombre_genero)
    {
        $this->nombre_genero = $nombre_genero;
    }
}

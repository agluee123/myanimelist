<?php
class Puntuacion    
{
    private $id_puntuacion;
    private $id_usuario;
    private $id_anime;
    private $voto_positivo;



    public function getIdPuntiacion()
    {
        return $this->id_puntuacion;
    }

    public function setIdPuntuacion($id_puntuacion)
    {
        $this->id_puntuacion = $id_puntuacion;
    }

    // Métodos getter y setter para $nombre
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getIdAnime()
    {
        return $this->id_anime;
    }

    public function setIdAnime($id_anime)
    {
        $this->id_anime = $id_anime;
    }

    public function getVotoPositivo()
    {
        return $this->voto_positivo;
    }

    public function setVotoPositivo($voto_positivo)
    {
        $this->id_usuario = $voto_positivo;
    }



}

?>
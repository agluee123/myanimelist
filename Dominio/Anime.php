<?php
class anime
{
    private $id_anime;
    private $nombre;
    private $descripcion;
    private $capitulos;
    private $estado;
    private $imagen_url;
    private $tipo;
    private $tomo;
    private $id_autor;
    private $id_genero;
    private $suma_votos;
    private $total_votos;


    // Métodos getter y setter para $id_anime
    public function getIdAnime()
    {
        return $this->id_anime;
    }

    public function setIdAnime($id_anime)
    {
        $this->id_anime = $id_anime;
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

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getCapitulos()
    {
        return $this->capitulos;
    }

    public function setCapitulos($capitulos)
    {
        $this->capitulos = $capitulos;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getImagenUrl()
    {
        return $this->imagen_url;
    }

    public function setImagenUrl($imagen_url)
    {
        $this->imagen_url = $imagen_url;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getTomo()
    {
        return $this->tomo;
    }

    public function setTomo($tomo)
    {
        $this->tomo = $tomo;
    }

    public function getIdAutor()
    {
        return $this->id_autor;
    }

    public function setIdAutor($id_autor)
    {
        $this->id_autor = $id_autor;
    }

    public function getIdGenero()
    {
        return $this->id_genero;
    }

    public function setIdGenero($id_genero)
    {
        $this->id_genero = $id_genero;
    }

    public function getSumaVotos()
    {
        return $this->suma_votos;
    }

    public function setSumaVotos($suma_votos)
    {
        $this->suma_votos = $suma_votos;
    }

    public function getTotalVotos()
    {
        return $this->total_votos;
    }

    public function setTotalVotos($total_votos)
    {
        $this->total_votos = $total_votos;
    }


}

?>
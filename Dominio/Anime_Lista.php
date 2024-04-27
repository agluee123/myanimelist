<?php
class Anime_Lista
{
    private $id_anime;
    private $id_lista;
    private $id_anime_lista;


    public function getIdAnime()
    {
        return $this->id_anime;
    }

    public function setIdAnime($id_anime)
    {
        $this->id_anime = $id_anime;
    }

    public function getIdLista()
    {
        return $this->id_lista;
    }

    public function setIdLista($id_lista)
    {
        $this->id_lista = $id_lista;
    }

    public function getIdAnimeLista()
    {
        return $this->id_anime_lista;
    }

    public function setIdAnimeLista($id_anime_lista)
    {
        $this->id_anime_lista = $id_anime_lista;
    }
}

<?php

namespace App\Model;

class Objectif extends AbstractModel
{
    /**
     * @var
     */
    private $idObjectif;

    /**
     * @var
     */
    private $content;

    //SETTERS

    /**
     * @param $idObjectif
     */
    public function setIdObjectif($idObjectif)
    {
        $this->idObjectif = (int) $idObjectif;
    }

    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    //GETTERS

    /**
     * @return mixed
     */
    public function getIdObjectif()
    {
        return $this->idObjectif;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}

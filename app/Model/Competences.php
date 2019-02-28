<?php

namespace App\Model;


class Competences extends AbstractModel
{
    /**
     * @var
     */
    private $idCompetences;

    /**
     * @var
     */
    private $content;

    //SETTERS

    /**
     * @param $idCompetences
     */
    public function setIdCompetences($idCompetences)
    {
        $this->idCompetences= (int) $idCompetences;
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
    public function getIdCompetences()
    {
        return $this->idCompetences;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}
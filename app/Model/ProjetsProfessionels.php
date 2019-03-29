<?php

namespace App\Model;

class ProjetsProfessionels extends AbstractModel
{
    /**
     * @var
     */
    private $idProjetsProfessionnels;

    /**
     * @var
     */
    private $titre;

    /**
     * @var
     */
    private $description;

    /**
     * @var
     */
    private $developpement;

    /**
     * @var
     */
    private $mission;

    //SETTERS

    /**
     * @param $idProjetsProfessionnels
     */
    public function setIdProjetsProfessionnels($idProjetsProfessionnels)
    {
        $this->idProjetsProfessionnels = (int) $idProjetsProfessionnels;
    }

    /**
     * @param $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param $developpement
     */
    public function setDeveloppement($developpement)
    {
        $this->developpement = $developpement;
    }

    /**
     * @param $mission
     */
    public function setMission($mission)
    {
        $this->mission = $mission;
    }

    //GETTERS

    /**
     * @return mixed
     */
    public function getIdProjetsProfessionnels()
    {
        return $this->idProjetsProfessionnels;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getDeveloppement()
    {
        return $this->developpement;
    }

    /**
     * @return mixed
     */
    public function getCMission()
    {
        return $this->mission;
    }
}

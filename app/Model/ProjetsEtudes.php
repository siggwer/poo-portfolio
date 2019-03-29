<?php

namespace App\Model;

class ProjetsEtudes extends AbstractModel
{
    /**
     * @var
     */
    private $idProjetsEtudes;

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
    private $mission;

    /**
     * @var
     */
    private $methodologieDeTravail;

    /**
     * @var
     */
    private $developpement;

    /**
     * @var
     */
    private $competencesValidees;

    //SETTERS

    /**
     * @param $idProjetsEtudes
     */
    public function setIdProjetsEtudes($idProjetsEtudes)
    {
        $this->idProjetsEtudes = (int) $idProjetsEtudes;
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
     * @param $mission
     */
    public function setMission($mission)
    {
        $this->mission = $mission;
    }

    /**
     * @param $methodologieDeTravail
     */
    public function setMethodologieDeTravail($methodologieDeTravail)
    {
        $this->methodologieDeTravail = $methodologieDeTravail;
    }

    /**
     * @param $developpement
     */
    public function setDeveloppement($developpement)
    {
        $this->developpement = $developpement;
    }

    /**
     * @param $competencesValidees
     */
    public function setCompetencesValidees($competencesValidees)
    {
        $this->competencesValidees = $competencesValidees;
    }

    //GETTERS

    /**
     * @return mixed
     */
    public function getIdProjetsEtudes()
    {
        return $this->idProjetsEtudes;
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
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * @return mixed
     */
    public function getMethodologieDeTravail()
    {
        return $this->methodologieDeTravail;
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
    public function getCompetencesValidees()
    {
        return $this->competencesValidees;
    }
}

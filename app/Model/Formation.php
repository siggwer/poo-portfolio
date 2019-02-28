<?php
namespace App\Model;


class Formation extends AbstractModel
{
    /**
     * @var
     */
    private $idFormation;

    /**
     * @var
     */
    private $nom;

    /**
     * @var
     */
    private $organisme;

    /**
     * @var
     */
    private $date_debut;

    /**
     * @var
     */
    private $date_fin;

    //SETTERS

    /**
     * @param $idFormation
     */
    public function setIdFormation($idFormation)
    {
        $this->idFormation = (int) $idFormation;
    }

    /**
     * @param $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param $organisme
     */
    public function setContent($organisme)
    {
        $this->organisme = $organisme;
    }

    /**
     * @param $date_debut
     */
    public function setDate_debut($date_debut)
    {
        $this->date_debut = $this->setDateTime($date_debut);
    }

    /**
     * @param $date_fin
     */
    public function setDate_fin($date_fin)
    {
        $this->date_fin = $this->setDateTime($date_fin);
    }

    //GETTERS

    /**
     * @return mixed
     */
    public function getIdFormation()
    {
        return $this->idFormation;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getOrganisme()
    {
        return $this->organisme;
    }

    /**
     * @return mixed
     */
    public function getDate_debut()
    {
        return $this->date_debut;
    }

    /**
     * @return mixed
     */
    public function getDate_fin()
    {
        return $this->date_fin;
    }
}
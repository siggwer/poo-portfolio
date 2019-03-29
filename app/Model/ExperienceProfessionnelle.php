<?php
namespace App\Model;

class ExperienceProfessionnelle extends AbstractModel
{
    /**
     * @var
     */
    private $idexperience_professionnelle;

    /**
     * @var
     */
    private $nom;

    /**
     * @var
     */
    private $date_debut;

    /**
     * @var
     */
    private $date_fin;

    /**
     * @var
     */
    private $titre;

    /**
     * @var
     */
    private $content;

    //SETTERS

    /**
     * @param $idexperience_professionnelle
     */
    public function setIdExperienceProfessionnelle($idexperience_professionnelle)
    {
        $this->idexperience_professionnelle = (int) $idexperience_professionnelle;
    }

    /**
     * @param $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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

    public function setTitre($titre)
    {
        $this->titre = $titre;
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
    public function getIdExperienceProfessionnelle()
    {
        return $this->idexperience_professionnelle;
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

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}
